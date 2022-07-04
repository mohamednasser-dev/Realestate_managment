<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionsAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class transactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::where('user_id', Auth::user()->id)->first();


        if (Auth::user()->type == "admin") {
            $transactions = Transaction::all();
        } else {
            if ($permission->all_trans == 'yes') {

                $transactions = Transaction::all();

            } elseif ($permission->branch_trans == 'yes') {
                $branch_id = Auth::user()->branch_id;
                $users = User::where('branch_id', $branch_id)->pluck('id');

                $transactions = Transaction::whereIn('user_id', $users)->get();


            } else {
                $transactions = Transaction::where('user_id', Auth::user()->id)->get();
            }
        }
        return view('transactions.index', \compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.exportcreate');
    }

    public function importcreate()
    {

        return view('transactions.importcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(
            \request(),
            [
                'type' => 'required',
                'status' => 'sometimes|nullable',
                'desc' => 'required',
                // 'number' => 'required',
                'trans_date' => 'required',
                'trans_type_id' => 'required',
                'thirdparty_id' => 'required',
                'note' => 'sometimes|nullable',
                'file' => 'sometimes|nullable'
            ]
        );

        // dd($request['submitbutton']);
        switch ($request->submitbutton) {

            case trans('admin.Add'):
                // dd('save');
                $data['user_id'] = Auth::user()->id;
                $number = Transaction::latest()->first();
                if ($number == null) {
                    $data['number'] = 1000;

                } else {
                    $data['number'] = $number->number + 1;

                }

                $user = Transaction::create($data);
                if ($request['file'] != null) {
                    // This is Image Information ...
                    foreach ($request['file'] as $image) {
                        # code...
                        $input['file'] = $this->MoveImage($image);
                        $input['name'] = $image->getClientOriginalName();
                        $input['transaction_id'] = $user->id;
                        TransactionsAttachment::create($input);
                    }
                }
                session()->flash('success', trans('admin.addedsuccess'));
                return redirect(url('transactions'));
                break;

            case trans('admin.barcode'):
                // dd('barcode');
                $transactionstypes = $request->all();
                $number = Transaction::latest()->first();
                if ($number == null) {
                    $transactionstypes['number'] = 1000;

                } else {
                    $transactionstypes['number'] = $number->number + 1;

                }
                $transactionstypes['id'] = null;


                return view('transactions.print', \compact('transactionstypes'));
                break;
        }


    }

    public function MoveImage($request_file)
    {
        // This is Image Information ...
        $file = $request_file;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();

        // Move Image To Folder ..
        $fileNewName = 'img_' . $size . '_' . time() . '.' . $ext;
        $file->move(public_path('uploads/attachment'), $fileNewName);

        return $fileNewName;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_data = Transaction::where('id', $id)->first();
        if ($user_data->type == 'export') {
            return view('transactions.exportedit', \compact('user_data'));
        } else {
            return view('transactions.importedit', \compact('user_data'));
        }
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
        $data = $this->validate(
            \request(),
            [

                'type' => 'required',
                'status' => 'sometimes|nullable',
                'desc' => 'required',
                'number' => 'required',
                'trans_date' => 'required',
                'trans_type_id' => 'required',
                'thirdparty_id' => 'required',
                'note' => 'sometimes|nullable',
            ]
        );


        Transaction::where('id', $id)->update($data);
        session()->flash('success', trans('admin.editsuccess'));


        return redirect(url('transactions'));
    }

    public function search(Request $request)
    {
        $transactions = null;
        $permission = Permission::where('user_id', Auth::user()->id)->first();

        if ($request->number != null) {
            $transactions = Transaction::where('number', $request->number)->get();
        } else {
            if (Auth::user()->type == "admin") {

                if ($request->user == "all" && $request->type == "all") {

                    $transactions = Transaction::all();
                } elseif ($request->user != "all" && $request->type != "all") {
                    $transactions = Transaction::where('user_id', $request->user)->where('type', $request->type)->get();
                } elseif ($request->user == "all" && $request->type != "all") {
                    $transactions = Transaction::where('type', $request->type)->get();
                } elseif ($request->user != "all" && $request->type == "all") {
                    $transactions = Transaction::where('user_id', $request->user)->get();
                }
            } else {
                if ($permission->all_trans == 'yes') {

                    $transactions = Transaction::all();
                    if ($request->type == "all") {
                        $transactions = Transaction::all();
                    } elseif ($request->type != "all") {
                        $transactions = Transaction::where('type', $request->type)->get();
                    }

                } elseif ($permission->branch_trans == 'yes') {
                    $branch_id = Auth::user()->branch_id;
                    $users = User::where('branch_id', $branch_id)->pluck('id');

                    if ($request->type == "all") {
                        $transactions = Transaction::whereIn('user_id', Auth::user()->id)->get();
                    } elseif ($request->type != "all") {
                        $transactions = Transaction::whereIn('user_id', Auth::user()->id)->where('type', $request->type)->get();
                    }

                } else {
                    if ($request->type == "all") {
                        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
                    } elseif ($request->type != "all") {
                        $transactions = Transaction::where('user_id', Auth::user()->id)->where('type', $request->type)->get();
                    }
                }


            }
        }
        return view('transactions.index', \compact('transactions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionstypes = Transaction::findOrFail($id);
        $transactionstypes->delete();
        session()->flash('success', trans('admin.deletesuccess'));


        return redirect(url('transactions'));
    }

    public function attachment($id)
    {

        $transaction_attachment = TransactionsAttachment::where('transaction_id', $id)->get();


        return view('transactions.attachment', \compact('transaction_attachment', 'id'));
    }

    public function addattachment(Request $request)
    {
        $data = $this->validate(
            \request(),
            [
                'transaction_id' => 'required',
                'file' => 'required'
            ]
        );

        $input = $request->all();
        // This is Image Information ...
        foreach ($request['file'] as $image) {
            # code...
            $input['file'] = $this->MoveImage($image);
            $input['name'] = $image->getClientOriginalName();
            $input['transaction_id'] = $request->transaction_id;
            TransactionsAttachment::create($input);
        }


        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('attachment/' . $request->transaction_id));
    }

    public function delete($id)
    {
        $TransactionsAttachment = TransactionsAttachment::findOrFail($id);
        $TransactionsAttachment->delete();
        session()->flash('success', trans('admin.deletesuccess'));
        return redirect(url()->previous());
    }

    public function generateBarcode($id)
    {

        $transactionstypes = Transaction::findOrFail($id);

        return view('transactions.print', \compact('transactionstypes'));
    }


}
