<?php

namespace App\Exports;

use App\Reciept;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RecieptsExcel implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($pay_type ,$fromdate,$todate,$type,$branch_id)
    {
        $this->pay_type = $pay_type;
        $this->fromdate = $fromdate;
        $this->todate = $todate;
        $this->type = $type;
        $this->branch_id = $branch_id;
    }
    public function view(): View
    {

        if ($this->pay_type == 'all') {
            $reciepts = Reciept::whereBetween('date', array($this->fromdate, $this->todate))
                ->where('type', $this->type)
                ->get();
        } else {
            $reciepts = Reciept::whereBetween('date', array($this->fromdate, $this->todate))
                ->where('type', $this->type)->where('pay_type', $this->pay_type)
                ->get();
        }

            return view('recipts.excel', [
                'reciepts' => $reciepts,
            ]);

    }
}
