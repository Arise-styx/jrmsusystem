<?php

namespace App\Exports;

use App\Models\Purchases;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchasedMaterialsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchases::select('requisitioner','brand','material_description','model_no','property_no','date_of_delivery','assigned_department','amount')->get();
    }

    public function headings(): array
    {
        return [
            'Requisitioner',
            'Brand',
            'Material Description',
            'Model Number',
            'Property Number',
            'Date Acquired',
            'Physical Location',
            'Requisition / Donation Cost',
        ];
    }
}
