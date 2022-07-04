<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use App\Reciept;
use App\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;


class UsersStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $users = User::all();
        $reciept = Reciept::where('type', 'قبض')->sum('amount');
        $reciept_total = Reciept::where('type', 'قبض')->sum('total');

        $reciept_out = Reciept::where('type', 'صرف')->sum('amount');
        $reciept_total_out = Reciept::where('type', 'صرف')->sum('total');
        $branch_id = null;
        $from = null;
        $to = null;
        return view('userstatistic.index', \compact('users','reciept_out','reciept_total_out', 'reciept', 'branch_id', 'reciept_total' ,'from','to'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'branch_id' => 'sometimes|nullable',
                'from' => 'sometimes|nullable|date',
                'to' => 'sometimes|nullable|date',
            ]
        );
        switch ($request->submitbutton) {

            case trans('admin.search'):
                if($request->branch_id !=null) {
                    $users = User::where('branch_id', $request->branch_id)->get();
                }else{
                    $users = User::all();
                }
                $usersid[] = null;
                foreach ($users as $key => $user) {
                    $usersid[$key] = $user->id;
                }
                if ($request->from == null || $request->to == null) {
                    $reciept = Reciept::where('type', 'قبض')->whereIn('user_id', $usersid)->sum('amount');
                    $reciept_total = Reciept::where('type', 'قبض')->whereIn('user_id', $usersid)->sum('total');
                } else {
                    $reciept = Reciept::where('type', 'قبض')->whereIn('user_id', $usersid)->whereBetween('date', [$request->from, $request->to])->sum('amount');
                    $reciept_total = Reciept::where('type', 'قبض')->whereIn('user_id', $usersid)->whereBetween('date', [$request->from, $request->to])->sum('total');

                }
                if ($request->from == null || $request->to == null) {
                    $reciept_out = Reciept::where('type', 'صرف')->whereIn('user_id', $usersid)->sum('amount');
                    $reciept_total_out = Reciept::where('type', 'صرف')->whereIn('user_id', $usersid)->sum('total');
                } else {
                    $reciept_out = Reciept::where('type', 'صرف')->whereIn('user_id', $usersid)->whereBetween('date', [$request->from, $request->to])->sum('amount');
                    $reciept_total_out = Reciept::where('type', 'صرف')->whereIn('user_id', $usersid)->whereBetween('date', [$request->from, $request->to])->sum('total');

                }

                $branch_id = $request->branch_id;
                $from = $request->from;
                $to = $request->to;

                return view('userstatistic.index', \compact('users','reciept_out','reciept_total_out', 'reciept', 'branch_id', 'reciept_total' ,'from','to'));
                break;


            case trans('admin.inexcel'):

                return (new UsersExport($request->branch_id, $request->from, $request->to))->download('احصائيات موظفين.xlsx');
                break;


            // case trans('admin.outexcel'):
            //     $users = User::where('branch_id', $request->branch_id)->get()->toArray();


            //     break;
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
