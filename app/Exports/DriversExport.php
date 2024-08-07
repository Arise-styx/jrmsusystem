<?php

namespace App\Exports;

use App\Models\Driver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DriversExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Driver::select('employee_id','fullname','drivers_license_no','dl_expiration','office')->orderByRaw("SUBSTRING_INDEX(fullname, ' ', -1)")->get();
        // return Driver::select('employee_id','fullname','drivers_license_no','dl_expiration','office')->orderBy('fullname')->get();
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Fullname',
            'License Number',
            'License Expiration Date',
            'Office',
        ];
    }
}
