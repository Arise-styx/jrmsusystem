<?php

namespace App\Http\Controllers;

// Laravel Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchasedMaterialsExport;
use App\Exports\DriversExport;
use App\Exports\FuelRequisitionExport;
use App\Exports\VehiclesExport;
use App\Exports\LaborTxnExport;
use App\Exports\PartsReplacementTxnExport;


use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reporting(Request $request) {
        $name = "Reporting";

        return view('backend.reporting', compact('name'));
    }

    // Report for Purchased Materials
    public function exportpurchasedmaterial(Request $request) {
        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = 'purchasedmaterialsreport-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new PurchasedMaterialsExport, $filename, $exportformat);
    }


    // Report for Drivers
    public function exportdriver(Request $request) {
        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = 'driversreport-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new DriversExport, $filename, $exportformat);
    }



    // Report for Vehicles
    public function exportvehicle(Request $request) {
        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = 'vehiclesreport-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new VehiclesExport, $filename, $exportformat);
    }

    // Report for Labor Transactions
    public function exportlabortxn(Request $request) {
        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = 'labortxnreport-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new LaborTxnExport, $filename, $exportformat);
    }


    // Report for Parts Replacement Transactions
    public function exportreplacementtxn(Request $request) {
        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = 'replacementtxns-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new PartsReplacementTxnExport, $filename, $exportformat);
    }


    // Report for Fuel Requisition
    public function exportfuelrequisition(Request $request) {
        // dd($request->accounting_code);
        $filters = [
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'employee' => $request->input('employee'),
            'gasolinestation' => $request->input('gasolinestation'),
            'type_of_fuel' => $request->input('type_of_fuel'),
            'plate_no' => strtoupper($request->input('plate_no')),
            'accounting_code' => $request->input('accounting_code')
        ];

        // dd($filters['plate_no']);

        $type = $request->exportformat;

        if ($type == "csv") {
            $extension = "csv";
            $exportformat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif ($type == "xlsx") {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif ($type == "xls") {
            $extension = "xls";
            $exportformat = \Maatwebsite\Excel\Excel::XLS;
        }
        else {
            $extension = "xlsx";
            $exportformat = \Maatwebsite\Excel\Excel::XLSX;
        }

        $filename = 'fuelrequisitions-'.date('d-m-Y').'.'.$extension;

        return Excel::download(new FuelRequisitionExport($filters), $filename, $exportformat);
    }


}
