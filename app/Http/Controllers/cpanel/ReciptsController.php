<?php

namespace App\Http\Controllers\cpanel;

use App\Branch;
use App\Client;
use App\Exports\RecieptsExcel;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\MainClient;
use App\MainData;
use App\Permission;
use App\Reciept;
use App\SmsLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReciptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->type == 'admin') {
            $reciepts = Reciept::all();
        } else {
            if ($permission->all_reciepts == 'yes') {

                $reciepts = Reciept::all();

            } elseif ($permission->branch_reciepts == 'yes') {
                $branch_id = Auth::user()->branch_id;
                $users = User::where('branch_id', $branch_id)->pluck('id');

                $reciepts = Reciept::whereIn('user_id', $users)->get();


            } else {
                $reciepts = Reciept::where('user_id', Auth::user()->id)->get();
            }


        }

        return view('recipts.index', \compact('reciepts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipts.createin');
    }

    public function createout()
    {
        return view('recipts.createout');
    }

    public function dataAjax(Request $request)
    {
        $data = MainClient::select("id", "name")->get();


        if ($request->has('q')) {
            $search = $request->q;
            $data = MainClient
                ::select("id", "name")
                ->where('name', 'LIKE', "%$search%")->orWhere('id_num', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->get();
        }


        return response()->json($data);
    }

    public function clientdata($id)
    {
//            main client id
        $data_client = Client::where('mainclient_id', $id)->pluck("id", "name");
        $data_client_table = Client::where('mainclient_id', $id)->get();
        //project  id
        $data_project = Client::where('id', $id)->first();
        $data_client_reciept = Reciept::where('client_id', $id)->where('type', 'قبض')->sum('amount');

        return response()->json(['data_project' => $data_project, 'data_client_table' => $data_client_table, 'data_client' => $data_client, 'data_client_reciept' => $data_client_reciept]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sms($mobile_num, $message)
    {
        $sms = SmsLog::all();
        $numberofmessages = MainData::first();
        $numberofmessages = $numberofmessages->numberofmessages;
        $usedsms = $sms->count();
        if ($numberofmessages > $usedsms) {

            SmsLog::create([
                'number' => $mobile_num,
                'sms' => $message
            ]);

            $ch = curl_init();
            $url = "http://basic.unifonic.com/rest/SMS/messages";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $message . "&SenderID=EmarSrh&Recipient=" . $mobile_num . "&encoding=UTF8&responseType=json"); // define what you want to post
            //  curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=fetoh@koof-ksa.com&password=fetoh000000&msg=".$Message."&sender=ALKHALIL-GR&to=".$user->phone."&encoding=UTF8"); // define what you want to post
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
        }

    }

    public function store(Request $request)
    {
        $data = $this->validate(
            \request(),
            [
                'client_id' => 'required',
                'type' => 'required',
                'date' => 'required',
                'pay_type' => 'required',
                'taxepercent' => 'sometimes|nullable',
                'total' => 'required',
                'amount' => 'required',
                'desc' => 'required',

            ]
        );
        if ($request->type == 'قبض') {
            if ($request->amount > $request->suubtotal) {
                session()->flash('error', 'مبلغ السند اكبر من المبلغ المتبقى برجاء التاكد من البيانات');
                return redirect()->back();

            }
        }
        $data['user_id'] = Auth::user()->id;
        $reciept = Reciept::create($data);
        if ($request->type == 'قبض') {
            if ($request->sendsms == 'yes') {
                $message = 'تم الاستلام من المكرم ' . $reciept->getClient->getMainClient->name . ' لمشروع ' . $reciept->getClient->name . ' مبلغ وقدرة  ' . $reciept->amount . '  ريال سعودي وذلك لسند قبض رقم ' . $reciept->id;

                $this->sms($reciept->getClient->getMainClient->phone, $message);
            }
        }
        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('recipts/' . $reciept->id));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reciept = Reciept::where('id', $id)->first();
        $user = User::whereId($reciept->user_id)->first();
        $branch_data = Branch::whereId($user->branch_id)->first();
        $client_id = $reciept->client_id;
        $data_client = Client::where('id', $client_id)->first();
        $data_client_reciept = Reciept::where('client_id', $client_id)->where('type', 'قبض')->sum('amount');

        $subtotal = $data_client->amount - $data_client_reciept;
        $maindata = MainData::first();
        return view('recipts.print', compact('reciept', 'maindata', 'data_client', 'subtotal', 'branch_data'));
    }

    public function taxreset(Request $request,$id)
    {
        $id = base64_decode($id);
        $reciept = Reciept::findOrFail($id);
        $user = User::whereId($reciept->user_id)->first();
        $branch_data = Branch::whereId($user->branch_id)->first();
        $client_id = $reciept->client_id;
        $data_client = Client::where('id', $client_id)->first();
        $data_client_reciept = Reciept::where('client_id', $client_id)->where('type', 'قبض')->sum('amount');

        $subtotal = $data_client->amount - $data_client_reciept;
        $maindata = MainData::first();

        $generatedString = [
            $this->toString($maindata->name_ar, '1'), //اسم الشركه
            $this->toString("300419725400003", '2'), // الرقم الضريبي
            $this->toString($reciept->created_at, '3'), // تاريخ ووقت الفاتورة
            $this->toString($reciept->amount, '4'), // المبلغ بعد الضريبة
            $this->toString($reciept->amount - $reciept->total, '5'), // مبلغ الضريبة
        ];

        $QRCode = $this->toBase64($generatedString);
        if($request->has('type')){
            $type = $request->type;
        }else{
            $type = null;
        }
        return view('recipts.taxreset', compact('type','QRCode','reciept', 'maindata', 'data_client', 'subtotal', 'branch_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function search(Request $request)
    {
        switch ($request->submitbutton) {

            case trans('admin.search'):

                $query = Reciept::whereBetween('date', array($request->fromdate, $request->todate));

                if ($request->pay_type == 'all') {
                    $query = $query->where('type', $request->type);

                } else {
                    $query = $query->where('type', $request->type)->where('pay_type', $request->pay_type);

                }
                if ($request->branch_id) {
                    $query = $query->whereHas('getUser', function ($q) use ($request) {
                        $q->where('branch_id', $request->branch_id);
                    });
                }

                $reciepts = $query->get();
                return view('recipts.index', \compact('reciepts'));
                break;


            case trans('admin.inexcel'):

                return (new RecieptsExcel($request->pay_type, $request->fromdate, $request->todate, $request->type, $request->branch_id))->download('ارشيف السندات.xlsx');
                break;


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Reciept::findOrFail($id);
        $cat->delete();
        session()->flash('success', trans('admin.deletesuccess'));
        return redirect(url('recipts'));
    }


    public function toBase64($value): string
    {
        return base64_encode($this->toTLV($value));
    }

    public function toTLV($value): string
    {
        return implode('', $value);
    }

    public function toString($value, $tag)
    {
        $value = (string)$value;

        return $this->toHex($tag) . $this->toHex($this->getLength($value)) . ($value);
    }

    protected function toHex($value)
    {
        return pack("H*", sprintf("%02X", $value));
    }

    public function getLength($value)
    {
        return strlen($value);
    }
}
