<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class DashboardExport implements FromView
{
    use Exportable;

    protected $groupedOrders;
    protected $startDate;
    protected $endDate;

    public function __construct($groupedOrders, $startDate, $endDate)
    {
        // dd($groupedOrders, $startDate, $endDate);
        $this->groupedOrders = $groupedOrders;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // dd($this->groupedOrders, $this->startDate, $this->endDate);

        return view('dashboard.report_excel', [
            'groupedOrders' => $this->groupedOrders,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }
}