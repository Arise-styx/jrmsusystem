<?php

namespace App\Exports;

use App\Models\PartsReplacementTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PartsReplacementTxnExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('backend.reports.partsreplacementtxn', [
            'replacementtxns' => PartsReplacementTransaction::with('driver', 'vehicle')->get()
        ]);
    }
}
