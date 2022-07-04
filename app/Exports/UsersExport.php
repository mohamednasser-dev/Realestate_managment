<?php

namespace App\Exports;

use App\User;
use App\Reciept;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($branch_id ,$from,$to)
    {
        $this->branch_id = $branch_id;
        $this->from = $from;
        $this->to = $to;
    }
    public function view(): View
    {
        if($this->branch_id !=null) {
            $users = User::where('branch_id', $this->branch_id)->get();
        }else{
            $users = User::all();
        }
        $usersid[] = null;
        foreach ($users as $key => $user) {
            $userid[$key] = $user->id;
        }

        if($this->from !=null && $this->to !=null) {
            return view('userstatistic.excel', [
                'users' => $users,
                'reciept' => Reciept::where('type', 'قبض')->whereIn('user_id', $userid)->whereBetween('date', [$this->from, $this->to])->sum('amount'),
                'reciept_total' => Reciept::where('type', 'قبض')->whereIn('user_id', $userid)->whereBetween('date', [$this->from, $this->to])->sum('total'),
                'from' => $this->from,
                'to' => $this->to,


            ]);
        }else{
            return view('userstatistic.excel', [
                'users' => $users,
                'reciept' => Reciept::where('type', 'قبض')->whereIn('user_id', $userid)->sum('amount'),
                'reciept_total' => Reciept::where('type', 'قبض')->whereIn('user_id', $userid)->sum('total'),
                'from' => $this->from,
                'to' => $this->to,
            ]);

        }
    }
}
