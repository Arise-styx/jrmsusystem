<?php

namespace App\Exports;

use App\Models\Vehicle;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class VehiclesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Vehicle::select('plate_no','vehicle_brand','vehicle_description','engine_no','chassis_no','or', 'cr_no', 'cr_expiration', 'department', 'office')->orderBy('cr_expiration')->get();
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Plate Number',
    //         'Vehicle Brand',
    //         'Vehicle Description',
    //         'Engine Number',
    //         'Chassis Number',
    //         'Official Receipt Number',
    //         'Certificate of Registration Number',
    //         'CR Expiration',
    //         'Department',
    //         'Office',
    //     ];
    // }

    public function view(): View
    {
        return view('backend.reports.vehiclesreport', [
            'vehicles' => Vehicle::with('driver')->get()
        ]);
    }

}
