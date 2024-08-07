<?php

namespace App\Exports;

use App\Models\LaborTransaction;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaborTxnExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('backend.reports.labortxnreport', [
            'labortxns' => LaborTransaction::with('driver', 'vehicle')->get()
        ]);

    }
}
