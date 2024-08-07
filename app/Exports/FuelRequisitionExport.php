<?php

namespace App\Exports;

use App\Models\fuel as Fuel;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class FuelRequisitionExport implements FromView
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function view(): View
//     {
//         return view('backend.reports.fuelrequisitions', [
//             'fuels' => Fuel::where('status', 'approved')->orderBy('created_at', 'desc')->get()
//         ]);

//     }
// }


class FuelRequisitionExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }


    public function view(): View
    {
        // Initial query
        $query = Fuel::query()->where('status', 'approved')->orderBy('created_at', 'asc');

        // Debugging: Fetch all data without filters
        $allFuels = $query->get();
        if ($allFuels->isEmpty()) {
            // Handle the case where no data is found
            return view('backend.reports.fuelrequisitions', [
                'fuels' => collect(), // Return an empty collection
                'message' => 'No records found'
            ]);
        }

        // Apply filters if provided
        if (!empty($this->filters)) {
            if (!empty($this->filters['date_from'])) {
                $query->whereDate('date', '>=', $this->filters['date_from']);
            }
            if (!empty($this->filters['date_to'])) {
                $query->whereDate('date', '<=', $this->filters['date_to']);
            }
            if (!empty($this->filters['employee'])) {
                $query->where('employee', $this->filters['employee']);
            }
            if (!empty($this->filters['gasolinestation'])) {
                $query->where('gasolinestation', $this->filters['gasolinestation']);
            }
            if (!empty($this->filters['type_of_fuel'])) {
                $query->where('type_of_fuel', $this->filters['type_of_fuel']);
            }
            if (!empty($this->filters['accounting_code'])) {
                $query->where('accounting_code', $this->filters['accounting_code']);
            }
            if (!empty($this->filters['plate_no'])) {
                $query->where('plate_no', $this->filters['plate_no']);
            }
            // Add more filters as needed
        }

        // Fetch filtered data
        $fuels = $query->get();

        // Debugging: Check if filtered data is returned
        if ($fuels->isEmpty()) {
            return view('backend.reports.fuelrequisitions', [
                'fuels' => collect(), // Return an empty collection
                'message' => 'No records found for the applied filters'
            ]);
        }

        // Return view with data
        return view('backend.reports.fuelrequisitions', [
            'fuels' => $fuels
        ]);
    }
}
