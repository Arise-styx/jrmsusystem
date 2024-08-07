<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Fpdf\Fpdf;
use Carbon\Carbon;
use App\Models\Fuel;
use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use setasign\Fpdi\Fpdi;
use App\Models\Approval;
use App\Models\Employee;
// use Barryvdh\DomPDF\Facade\Pdf;
use mikehaertl\pdftk\Pdf;
use Illuminate\Http\Request;

// DomPDF for Report
use App\Models\AccountingCode;

use App\Models\GasolineStation;
use App\Models\LaborTransaction;
use App\Models\PetroleumProduct;
use App\Models\EngineDescriptions;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\PartsReplacementTransaction;
use Illuminate\Pagination\LengthAwarePaginator;


class HRController extends Controller
{

    //** Manage Purchased Materials **//

    // // Landing Page Motorpool Info System // //
    public function motorpool()
    {
        $name = "Motorpool Information";
        // $message = "";
        $drivers = Driver::orderBy('created_at', 'desc')->get();;
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();;

        return view('backend.motorpool.motorpool', compact('name', 'drivers', 'vehicles'));
    }

    // //------ All Drivers ------// //
    public function alldrivers()
    {
        $name = "All Drivers";
        $drivers = Driver::orderBy('created_at', 'desc')->get();

        return view('backend.motorpool.alldrivers', compact('name', 'drivers'));
    }

    // // Add Driver // //
    public function adddriverpage()
    {
        $name = "Add Driver";
        return view('backend.motorpool.adddriverpage', compact('name'));
    }

    public function adddriver(Request $request)
    {
        $name = "Add Driver";
        // Validations
        $validateData = $request->validate([
            'employee_id' => 'required|string',
            'fullname' => 'required|string',
            'drivers_license_no' => 'required|string',
            'dl_expiration' => 'required|date',
            'office' => 'required|string',
        ]);

        // $user_id = Auth::id();


        Driver::insert([
            'employee_id' => $request->employee_id,
            'fullname' => $request->fullname,
            'drivers_license_no' => $request->drivers_license_no,
            'dl_expiration' => $request->dl_expiration,
            'office' => $request->office,
            'created_at' => Carbon::now(),
        ]);

        // $message = 'success';

        return Redirect()->route('adddriverpage')->with([
            'success' => 'Driver Added Successfully!',
            'name' => $name
        ]);
    }

    // // Update Driver Information
    public function editdriver($id)
    {
        $name = "Edit Driver";
        $driver = Driver::findOrFail($id);
        return view('backend.motorpool.editdrivers', compact('name', 'driver'));
    }

    public function updatedriver(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|string',
            'fullname' => 'required|string',
            'drivers_license_no' => 'required|string',
            'dl_expiration' => 'required|date',
            'office' => 'required|string',
        ]);

        // Find the driver by ID
        $driver = Driver::findOrFail($id);

        // Update the driver information
        $driver->update($validatedData);

        // Redirect back to the drivers list page
        return redirect()->route('motorpool')->with('updated', 'Driver information updated successfully!');
    }

    // // Delete Driver
    public function deletedriver($id)
    {
        // Find the driver by ID
        // $driver = Driver::findOrFail($id);

        Driver::find($id)->delete();

        // Delete the driver
        // $driver->delete();

        // Redirect back to the drivers list page
        return redirect()->route('motorpool')->with('deleted', 'Driver deleted successfully!');
    }


    // //------ All Vehicles ------// //
    public function allvehicles()
    {
        $name = "All Vehicles";
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();

        return view('backend.motorpool.allvehicles', compact('name', 'vehicles'));
    }

    // // Add Vehicle // //
    public function addvehiclepage()
    {
        $name = "Add Vehicle";
        $drivers = Driver::orderBy('created_at', 'desc')->get();

        return view('backend.motorpool.addvehiclepage', compact('name', 'drivers'));
    }

    public function addvehicle(Request $request)
    {
        $name = "Add Vehicle";
        // Validations
        $validateData = $request->validate([
            'plate_no' => 'required|string',
            'vehicle_description' => 'required|string',
            'vehicle_brand' => 'required|string',
            'engine_no' => 'required|string',
            'chassis_no' => 'required|string',
            'or' => 'required|date',
            'cr_no' => 'required|string',
            'cr_expiration' => 'required|date',
            'driver_id' => 'required|integer',
            'department' => 'required|string',
            'office' => 'required|string',
        ]);

        // $user_id = Auth::id();


        Vehicle::insert([
            'plate_no' => $request->plate_no,
            'vehicle_description' => $request->vehicle_description,
            'vehicle_brand' => $request->vehicle_brand,
            'engine_no' => $request->engine_no,
            'chassis_no' => $request->chassis_no,
            'or' => $request->or,
            'cr_no' => $request->cr_no,
            'cr_expiration' => $request->cr_expiration,
            'driver_id' => $request->driver_id,
            'department' => $request->department,
            'office' => $request->office,
            'created_at' => Carbon::now(),
        ]);

        // $message = 'success';

        return Redirect()->route('addvehiclepage')->with([
            'success' => 'Vehicle Added Successfully!',
            'name' => $name
        ]);
    }

    // // Update Vehicle Information // //
    public function editvehicle($id)
    {
        $name = "Edit Vehicle";
        $vehicle = Vehicle::findOrFail($id);
        // Fetch drivers from the database
        $drivers = Driver::all();
        return view('backend.motorpool.editvehicle', compact('name', 'vehicle', 'drivers'));
    }

    public function updatevehicle(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'driver_id' => 'required|integer',
            'or' => 'required|date',
            'cr_no' => 'required|string',
            'cr_expiration' => 'required|date',
            'department' => 'required|string',
            'office' => 'required|string',
        ]);

        // Find the driver by ID
        $vehicle = Vehicle::findOrFail($id);

        // Update the driver information
        $vehicle->update($validatedData);

        // Redirect back to the motorpool list page
        return redirect()->route('motorpool')->with('updated', 'Vehicle information updated successfully!');
    }

    // // Delete Vehicle // //
    public function deleteVehicle($id)
    {

        Vehicle::find($id)->delete();

        // Redirect back to the motorpool  list page
        return redirect()->route('motorpool')->with('deleted', 'Vehicle  deleted successfully!');
    }


    // //------ All Labor Transactions ------// //
    public function alllabor()
    {
        $name = "Labor Transactions";
        $drivers = Driver::orderBy('created_at', 'desc')->get();
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        $laborTransactions = LaborTransaction::orderBy('created_at', 'desc')->get();

        return view('backend.motorpool.alllabor', compact('name', 'drivers', 'vehicles', 'laborTransactions'));
    }

    // // Add Labor // //
    public function addlaborpage()
    {
        $name = "Add Labor Transaction";
        $drivers = Driver::all();
        $vehicles = Vehicle::all();

        return view('backend.motorpool.addlabortxnpage', compact('name', 'drivers', 'vehicles'));
    }

    public function addlabor(Request $request)
    {
        $name = "Add Labor Transaction";
        // Validations
        $validatedData = $request->validate([
            'type_of_labor' => 'required|string',
            'shop_mechanic' => 'required|string',
            'or_no' => 'required|string',
            'date_of_labor' => 'required|date',
            'odometer' => 'integer',
            'driver_id' => 'required|string',
            'vehicle_id' => 'required|string',
            'amount' => 'string',
            'remarks' => 'string',
        ]);

        // $user_id = Auth::id();


        LaborTransaction::insert([
            'type_of_labor' => $request->type_of_labor,
            'shop_mechanic' => $request->shop_mechanic,
            'or_no' => $request->or_no,
            'date_of_labor' => $request->date_of_labor,
            'odometer' => $request->odometer,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'created_at' => Carbon::now(),
        ]);

        // $message = 'success';

        return Redirect()->route('alllabor')->with([
            'success' => 'Labor Transaction Added Successfully!',
            'name' => $name
        ]);
    }

    // // Update Labor Transaction Information // //
    public function editlabor($id)
    {
        $name = "Edit Labor Transaaction";
        $labortxn = LaborTransaction::findOrFail($id);
        $vehicle = Vehicle::findOrFail($labortxn->vehicle_id);
        $driver = Driver::findOrFail($labortxn->driver_id);

        $drivers = Driver::orderBy('created_at', 'desc')->get();
        return view('backend.motorpool.editlabortxn', compact('name', 'vehicle', 'driver', 'labortxn'));
    }

    public function updatelabor(Request $request, $id)
    {
        // Validate the request data

        $validatedData = $request->validate([
            'type_of_labor' => 'required|string',
            'shop_mechanic' => 'required|string',
            'or_no' => 'required|string',
            'date_of_labor' => 'required|date',
            'odometer' => 'integer',
            'amount' => 'required|numeric',
            // 'remarks' => 'string',
        ]);

        LaborTransaction::find($id)->update([
            'type_of_labor' => $request->type_of_labor,
            'shop_mechanic' => $request->shop_mechanic,
            'or_no' => $request->or_no,
            'date_of_labor' => $request->date_of_labor,
            'odometer' => $request->odometer,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'updated_at' => Carbon::now(),
        ]);

        // Redirect back to the motorpool list page
        return redirect()->route('alllabor')->with('updated', 'Labor Transaction updated successfully!');
    }


    // // Delete Labor Transaction // //
    public function deletelabor($id)
    {

        $name = "Delete Labor Transaction";

        LaborTransaction::find($id)->delete();

        return Redirect()->back()->with("deleted", "Material deleted successfully!");
    }


    // //------ All Labor Transactions ------// //
    public function allpartsreplacement()
    {
        $name = "Parts Replacement Transactions";

        $partsreplacementtxns = PartsReplacementTransaction::orderBy('created_at', 'desc')->get();

        return view('backend.motorpool.allpartsreplacement', compact('name', 'partsreplacementtxns'));
    }


    // // Add Parts Replacement // //
    public function addreplacementpage()
    {
        $name = "Add Parts Replacement";
        $drivers = Driver::all();
        $vehicles = Vehicle::all();

        return view('backend.motorpool.addpartsreplacedtxnpage', compact('name', 'drivers', 'vehicles'));
    }

    public function addreplacement(Request $request)
    {
        $name = "Add Parts Replacement Transaction";
        // Validations
        $validatedData = $request->validate([
            'parts_replaced' => 'required|string',
            'shop_supplier' => 'required|string',
            'or_no' => 'required|string',
            'date_of_replacement' => 'required|date',
            'odometer' => 'required|string',
            'driver_id' => 'required|string',
            'vehicle_id' => 'required|string',
            'amount' => 'required|numeric',
            'remarks' => 'required|string',
        ]);

        // $user_id = Auth::id();


        PartsReplacementTransaction::insert([
            'parts_replaced' => $request->parts_replaced,
            'shop_supplier' => $request->shop_supplier,
            'or_no' => $request->or_no,
            'date_of_replacement' => $request->date_of_replacement,
            'odometer' => $request->odometer,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'created_at' => Carbon::now(),
        ]);

        // $message = 'success';

        return Redirect()->route('allpartsreplacement')->with([
            'success' => 'Part Replacement Transaction Added Successfully!',
            'name' => $name
        ]);
    }


    // // Update Parts Replacement Transaction // //
    public function editpartsreplacement($id)
    {
        $name = "Edit Parts Replacement Transaaction";
        $partsreplacementtxn = PartsReplacementTransaction::findOrFail($id);
        $vehicle = Vehicle::findOrFail($partsreplacementtxn->vehicle_id);
        $driver = Driver::findOrFail($partsreplacementtxn->driver_id);

        return view('backend.motorpool.editpartsreplacementtxn', compact('name', 'vehicle', 'driver', 'partsreplacementtxn'));
    }

    public function updatepartsreplacement(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'parts_replaced' => 'required|string',
            'shop_supplier' => 'required|string',
            'or_no' => 'required|string',
            'date_of_replacement' => 'required|date',
            'odometer' => 'integer',
            'amount' => 'required|numeric',
            // 'remarks' => 'string',
        ]);


        PartsReplacementTransaction::find($id)->update([
            'parts_replaced' => $request->parts_replaced,
            'shop_supplier' => $request->shop_supplier,
            'or_no' => $request->or_no,
            'date_of_replacement' => $request->date_of_replacement,
            'odometer' => $request->odometer,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'updated_at' => Carbon::now(),
        ]);

        // Redirect back to the motorpool list page
        return redirect()->route('allpartsreplacement')->with('updated', 'Parts Replacement Transactions updated successfully!');
    }


    // // Delete Replacement Transaction // //
    public function deletepartsreplacement($id)
    {

        $name = "Delete Parts Replacement Transaction";

        PartsReplacementTransaction::find($id)->delete();

        return Redirect()->back()->with("deleted", "Material deleted successfully!");
    }


    // // Landing Page Gasoline Approval System // //
    public function fuelrequisition()
    {
        $name = "Fuel Requisition System";

        $user = auth()->user();

        // $fuels = $user->fuels;
        // $fuels = $user->fuels->sortByDesc('created_at');
        $fuels = Fuel::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('backend.fuelrequestapproval.allfuelrequisition', compact('name', 'fuels', 'user'));
    }

    // // Add Gasoline Request // //
    // public function addgasolinepage()
    public function addfuelrequestpage()
    {
        $name = "Request Fuel";
        $user = auth()->user();
        // $drivers = Driver::all();
        // $vehicles = Vehicle::all();
        $employees = Employee::orderBy('lname')->get();
        $engine_descriptions = EngineDescriptions::all();
        $petroleumproducts = PetroleumProduct::select('name')->distinct()->get();

        return view('backend.fuelrequestapproval.addfuelrequestpage', compact('name', 'employees', 'engine_descriptions', 'user', 'petroleumproducts'));
    }

    public function addfuelrequest(Request $request)
    {
        $name = "Add Fuel Request";
        $user = auth()->user();
        // dd($request);

        // Validations
        $validatedData = $request->validate([
            // 'employee' => 'required|string',
            'date' => 'required|date',
            'engine_description' => 'required|string',
            'plate_no' => 'string',
            // 'gasolinestation' => 'required|string',
            'type_of_fuel' => 'required|string',
            'purpose' => 'required|string',
        ]);

        $plate_no = $request->input('plate_no');

        $odometer = $request->odometer;

        // Calculate the amount
        $user_id = Auth::id();
        $user = User::find($user_id);

        $employee_obj = Employee::findOrFail(intval($request->employee));
        $employee_name = $employee_obj->fname . ' ' . $employee_obj->lname;

        // For MIS Purposes Property Number
        $date = new DateTime($request->date);
        $formattedDate = $date->format('Y-m');

        $date = new DateTime($request->date);
        $formattedDate = $date->format('Y-m');

        // Get the last issued control number from the database
        $latestFuelSlipNo = Fuel::latest()->first();

        if ($latestFuelSlipNo) {
            // Extract the date and series number from the last control number
            $lastFormattedDate = substr($latestFuelSlipNo->fuel_slip_no, 0, 7);
            $lastSeriesNo = (int)substr($latestFuelSlipNo->fuel_slip_no, 8);

            if ($formattedDate === $lastFormattedDate) {
                // Increment the series number if the month is the same
                $newSeriesNo = $lastSeriesNo + 1;
            } else {
                // Reset the series number if the month has changed
                $newSeriesNo = 1;
            }
        } else {
            // Initialize series number if there is no previous fuel slip number
            $newSeriesNo = 1;
        }

        // Format the new series number as 3 digits
        $formattedSeriesNo = sprintf('%03d', $newSeriesNo);

        // Concatenate the formatted date and series number
        $fuel_slip_no = $formattedDate . '-' . $formattedSeriesNo;


        // Insert data into the database
        // $fuelRequest = Fuel::insert([
        Fuel::insert([
            'employee' => $employee_name,
            'employee_tb_id' => $employee_obj->id,
            'engine_description' => $request->engine_description,
            'date' => $request->date,
            'plate_no' => strtoupper($request->plate_no),
            'odometer' => $request->odometer,
            // 'gasolinestation' => $request->gasolinestation,
            'type_of_fuel' => $request->type_of_fuel,
            // 'liter' => $request->liter,
            // 'price' => $request->price,
            'purpose' => $request->purpose,
            'fuel_slip_no' => $fuel_slip_no,
            // 'amount' => $amount,
            'status' => 'pending', // Default status as pending
            'created_at' => Carbon::now(),
            'user_id' => $user_id,
        ]);


        return Redirect()->route('fuelrequisition')->with([
            'success' => 'Fuel Request Added Successfully!',
            'name' => $name,
            'user' => $user
        ]);
    }


    public function headsdashboard($id)
    {
        $name = "Fuel Requests Approval";
        $fuel = Fuel::find($id);
        $gasolinestations = GasolineStation::all();
        $petroleumproducts = PetroleumProduct::where('name', $fuel->type_of_fuel)->get();

        // dd($petroleumproducts[0]['price']);
        $user = auth()->user();
        // $employees = Employee::orderBy('lname')->get();
        $accounting_codes = AccountingCode::all();

        $group_name = "";
        $requesting_employee = Employee::findOrFail($fuel->employee_tb_id);

        if ($requesting_employee->employment_group == "bod") {
            $group_name = "Board of Director";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "mtr") {
            $group_name = "Meter Reader Crew";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "dis") {
            $group_name = "Disconnection Crew";
        } else {
            $group_name = "Employee";
        }

        $userIds = Approval::where('fuel_id', $id)->pluck('user_id')->toArray();
        $approvals = User::whereIn('id', $userIds)->get();

        // dd($fuel->approvals->employee);
        $corplanApproved = $fuel->hasCorplanApproved();
        $alreadyApproved = $fuel->hasBeenApprovedBy($user);
        $corplanrole = $user->roles->contains('name', 'corplan');

        // $for_finance = $fuel->hasRoleApproved('for_finance');
        // $for_general_manager = $fuel->hasRoleApproved('for_finance');

        // Check if the fuel exists
        if (!$fuel) {
            return redirect()->route('headsdashboard')->with('error', 'Fuel entry not found.');
        }

        // return view('backend.fuelrequestapproval.headsdashboard', compact('name', 'fuel', 'alreadyApproved', 'corplanrole', 'corplanApproved', 'user', 'employees', 'group_name', 'approvals', 'gasolinestations', 'petroleumproducts'));
        return view('backend.fuelrequestapproval.headsdashboard', compact('name', 'fuel', 'alreadyApproved', 'corplanrole', 'corplanApproved', 'user', 'group_name', 'approvals', 'gasolinestations', 'petroleumproducts'));
    }


    public function fuelrequestsdashboard()
    {
        $name = "Fuel Request";
        $user = auth()->user();


        // Separate approved and unapproved fuel requests
        $oneWeekAgo = Carbon::now()->subWeek();
        $approvedfuelrequests = Fuel::where('status', 'approved')
            ->where('created_at', '>=', $oneWeekAgo)
            ->orderByDesc('created_at')
            ->get();

        $unapprovedfuelrequests = Fuel::where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        $employees = Employee::orderBy('lname')->get();
        $accounting_codes = AccountingCode::all();

        return view('backend.fuelrequestapproval.fuelrequestsdashboard', compact('name', 'user', 'approvedfuelrequests', 'unapprovedfuelrequests', 'employees', 'accounting_codes'));
    }

    public function rejectedfuelrequestsdashboard()
    {
        $name = "Rejected Fuel Requests";
        $user = auth()->user();

        $oneWeekAgo = Carbon::now()->subWeek();

        $rejectedfuelrequests = Fuel::where('status', 'rejected')
            ->where('created_at', '>=', $oneWeekAgo)
            ->orderByDesc('created_at')
            ->get();


        return view('backend.fuelrequestapproval.rejectedfuelrequestsdashboard', compact('name', 'user', 'rejectedfuelrequests'));
    }



    public function destroy($id)
    {
        $fuel = Fuel::findOrFail($id);
        $fuel->delete();

        return redirect()->back()->with('deleted', 'Fuel request has been deleted successfully.');
    }


    public function approvalprint($id)
    {
        $fuel = Fuel::findOrFail($id);
        $requesting_employee = Employee::findOrFail($fuel->employee_tb_id);


        $userIds = Approval::where('fuel_id', $id)->pluck('user_id')->toArray();
        $approvals = Approval::where('fuel_id', $id)
            ->with('user.employee') // Assuming there's a 'user' relationship in Approval model and 'employee' relationship in User model
            ->orderByRaw('FIELD(user_id, ' . implode(',', $userIds) . ')')
            ->get();

        $approvedUsers = [];
        foreach ($approvals as $approval) {
            $approvedUsers[] = [
                'user' => $approval->user->employee ? $approval->user->employee->fname . ' ' . $approval->user->employee->lname : '',
                'designation' => $approval->user->employee ? $approval->user->employee->designation : '',
                'approval_for' => $approval->approval_for,
            ];
        }

        $fillablePdfPath = 'report_template/FUEL REQUISITION_3.pdf';
        $tempPdfPath = 'report_template/temp_output.pdf';

        $date = date('Y-m-d');
        $fileName = $requesting_employee->fname . '_' . $date . '.pdf';

        $outputPdfPath = 'report_template/' . $fileName;
        $group_name = "";

        if ($requesting_employee->employment_group == "bod") {
            $group_name = "Board of Director";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "mtr") {
            $group_name = "Meter Reader Crew";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "dis") {
            $group_name = "Disconnection Crew";
        } else {
            $group_name = "Employee";
        }

        // Endorsed by = Corplan
        // Checked by = Audit
        // Recommending Approval = Finance
        // Approved by = general-manager

        $endorsedby_name = "";
        $endorsedby_desig = "";

        $checkedby_name = "";
        $checkedby_desig = "";

        $recommendapprov_name = "REXY ANNE BAÑEZ";
        $recommendapprov_desig = "Finance Services Dept. Manager";
        $for_recommendapprov_sig = "";
        $for_recommendapprov = "";

        $approved_name = "DANILO CABURAL";
        $approved_desig = "OIC General Manager";
        $for_approved_sig = "";
        $for_approved = "";

        foreach ($approvedUsers as $approve) {
            if ($approve["approval_for"] == "corplan") {
                $endorsedby_name = $approve["user"];
                $endorsedby_desig = $approve["designation"];
            } elseif ($approve["approval_for"] == "audit") {
                $checkedby_name = $approve["user"];
                $checkedby_desig = $approve["designation"];
            } elseif ($approve["approval_for"] == "finance") {
                $recommendapprov_name = $approve["user"];
                $recommendapprov_desig = $approve["designation"];
            } elseif ($approve["approval_for"] == "general-manager") {
                $approved_name = $approve["user"];
                $approved_desig = $approve["designation"];
            } elseif ($approve["approval_for"] == "for_finance") {
                $for_recommendapprov_sig = $approve["user"];
                $for_recommendapprov = "for";
            } elseif ($approve["approval_for"] == "for_general-manager") {
                $for_approved_sig = $approve["user"];
                $for_approved = "for";
            }
        }

        // // Prepare the data array, including approved users
        $data = [
            'fuel_slip_no' => $fuel->fuel_slip_no,
            'gasolinestation' => $fuel->gasolinestation,
            'date' => date('m-d-Y', strtotime($fuel->date)),
            'plate_no' => $fuel->plate_no,
            'type_of_fuel' => $fuel->type_of_fuel,
            'engine_description' => $fuel->engine_description,
            // 'liter' => $fuel->liter,
            'liter' => number_format($fuel->liter, 1),
            'purpose' => $fuel->purpose,
            'employee' => strtoupper($fuel->employee),
            'group_name' => $group_name,
            'endorsedby_name' => strtoupper($endorsedby_name),
            'endorsedby_desig' => $endorsedby_desig,
            'checkedby_name' => strtoupper($checkedby_name),
            'checkedby_desig' => $checkedby_desig,
            'recommendapprov_name' => strtoupper($recommendapprov_name),
            'recommendapprov_desig' => $recommendapprov_desig,
            'for_recommendapprov' => $for_recommendapprov,
            'approved_name' => strtoupper($approved_name),
            'approved_desig' => $approved_desig,
            'for_approved' => $for_approved
        ];

        // // Fill the PDF form with pdftk
        $pdf = new Pdf($fillablePdfPath);
        $pdf->fillForm($data)
            ->flatten()
            ->saveAs($tempPdfPath);

        if ($pdf->getError()) {
            throw new \Exception('Error filling PDF form: ' . $pdf->getError());
        }

        // // Create FPDI instance and set paper size
        $fpdi = new Fpdi();
        $fpdi->AddPage('P', [109.22, 220.98]);

        $pageCount = $fpdi->setSourceFile($tempPdfPath);
        $tplIdx = $fpdi->importPage(1);
        $fpdi->useTemplate($tplIdx, 0, 0, 109.22, 220.98);

        // Example signatures (assuming you have conditions to determine which signature to place where)

        // Corplan / Endorsed by Signature
        $fpdi->Image('report_template/' . $endorsedby_name . '.png', 18, 140, 20, 15);
        $fpdi->Image('report_template/' . $checkedby_name . '.png', 65, 110, 20, 15);

        // if (isset($approvedUsers[0])) {
        //     $fpdi->Image('report_template/agustinarabes.png', 18, 140, 20, 15);
        // }
        // if (isset($approvedUsers[1])) {
        //     $fpdi->Image('report_template/clairecornelia.png', 65, 110, 20, 15);
        // }

        if (!empty($for_recommendapprov)) {
            $fpdi->Image('report_template/' . $for_recommendapprov_sig . '.png', 65, 140, 20, 15);
        } else {
            $fpdi->Image('report_template/' . $recommendapprov_name . '.png', 65, 140, 20, 15);
        }

        if (!empty($for_approved)) {
            $fpdi->Image('report_template/' . $for_approved_sig . '.png', 65, 172, 20, 15);
        } else {
            $fpdi->Image('report_template/' . $approved_name . '.png', 65, 172, 20, 15);
        }

        // if (isset($approvedUsers[2])) {
        //     $fpdi->Image('report_template/rexyannebañez.png', 65, 140, 20, 15);
        // }
        // if (isset($approvedUsers[3])) {
        //     $fpdi->Image('report_template/danilocabural.png', 65, 172, 20, 15);
        // }

        $fpdi->Output($outputPdfPath, 'F');

        return response()->download($outputPdfPath)->deleteFileAfterSend(true);
    }

    public function approve(Request $request, $id)
    {
        // Reject
        if ($request->remarks !== null) {
            $fuelRejection = new Approval();



            $fuelRejection->rejectFuelRequest($id);
            $fuel = Fuel::findOrFail($id);

            $fuel->update([
                'remarks' => $request->remarks,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('fuelrequestsdashboard')->with('success', 'Fuel request rejected successfully.');

            // Approve
        } else {

            $fuelApproval = new Approval();

            // $for_employee = $request->for_employee;

            // // Check if the request is pending and if the authenticated user is HR
            // if ($fuelApproval->approveFuelRequest($id, $for_employee)) {
            if ($fuelApproval->approveFuelRequest($id)) {
                $fuelRequest = Fuel::findOrFail($id);

                // Update the fields in the fuel request
                $amount = $request->liter * $request->price;

                // $gasolinestation = GasolineStation::find($request->gasolinestation)->name;

                if(is_numeric($request->gasolinestation)) {
                    $gasolinestation = GasolineStation::find($request->gasolinestation)->name;
                } else {
                    $gasolinestation = $request->gasolinestation;
                }


                // dd($request->date);

                $fuelRequest->update([
                    'employee' => $request->employee,
                    'date' => $request->date,
                    'engine_description' => $request->engine_description,
                    'plate_no' => $request->plate_no,
                    'odometer' => $request->odometer,
                    'gasolinestation' => $gasolinestation,
                    'type_of_fuel' => $request->type_of_fuel,
                    'liter' => $request->liter,
                    // 'liter' => number_format($request->liter, 1),
                    'price' => $request->price,
                    'amount' => $amount,
                    'purpose' => $request->purpose,
                    'created_at' => $request->created_at,
                    'updated_at' => Carbon::now(),
                ]);


                return redirect()->back()->with('success', 'Fuel request approved successfully.');
            } else {
                // If the request is not pending or the user is not authorized, return an error
                return redirect()->back()->with('error', 'Unable to approve the fuel request.');
            }
        }
    }


    public function downloadfuelrequestsdashboard()
    {
        $name = "Download Fuel Request";

        $user = auth()->user();

        // $fuels = $user->fuels;
        // $fuels = Fuel::where('status', 'approved')
        //     ->orderByDesc('created_at')
        //     ->get();
        $fuels = Fuel::orderByDesc('created_at')->get();
        // $oneWeekAgo = Carbon::now()->subWeek();
        // $fiveDaysAgo = Carbon::now()->subDays(5);
        // $fuels = Fuel::where('created_at', '>=', $fiveDaysAgo)
        //     ->orderByDesc('created_at')
        //     ->get();

        return view('backend.fuelrequestapproval.downloadfuelrequestsdashboard', compact('name', 'fuels', 'user'));
    }


    public function cancelfuelrequest(Request $request, $id)
    {
        $fuel = Fuel::findOrFail($id);

        $fuel->update([
            'status' => 'cancelled',
            'remarks' => $request->remarks,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('downloadfuelrequestsdashboard')->with('removed', 'Fuel request cancelled successfully.');
    }


    // Add Accounting Code //

    public function addaccountingcodedashboard()
    {
        $name = "Add Accounting Code Dashboard";

        $user = auth()->user();
        // $fuels = $user->fuels;
        // $fuels = Fuel::where('status', 'approved')
        //     ->orderByDesc('created_at')
        //     ->get();
        // $fuels = Fuel::orderByDesc('created_at')->get();
        $oneWeekAgo = Carbon::now()->subWeek();
        $fuels = Fuel::where('status', 'approved')
            ->where('created_at', '>=', $oneWeekAgo)
            ->whereNull('accounting_code')
            ->orderByDesc('created_at')
            ->get();

        $employees = Employee::orderBy('lname')->get();
        $accounting_codes = AccountingCode::all();

        return view('backend.fuelrequestapproval.addaccountingdashboard', compact('name', 'fuels', 'user', 'employees', 'accounting_codes'));
    }

    public function addaccountingcodepage($id)
    {
        $name = "Add Accounting Code";
        $fuel = Fuel::findOrFail($id);
        $user = Auth::user();

        $group_name = "";
        $requesting_employee = Employee::findOrFail($fuel->employee_tb_id);

        if ($requesting_employee->employment_group == "bod") {
            $group_name = "Board of Director";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "mtr") {
            $group_name = "Meter Reader Crew";
        } elseif ($requesting_employee->employment_group == "con" && $requesting_employee->employment_subgroup == "dis") {
            $group_name = "Disconnection Crew";
        } else {
            $group_name = "Employee";
        }

        // $requesting_employee = Employee::findOrFail($fuel->employee_tb_id);
        $accounting_codes = AccountingCode::all();

        return view('backend.fuelrequestapproval.addaccountingcodepage', compact('name', 'fuel', 'user', 'group_name', 'accounting_codes'));
    }

    public function addaccountingcode(Request $request, $id)
    {
        $name = "Update Accouting Code";
        $user = auth()->user();

        // Validations
        $validatedData = $request->validate([
            // 'employee' => 'required|string',
            'accounting_code' => 'required|string'
        ]);

        $user_id = Auth::id();

        // Find the fuel by ID
        $fuel = Fuel::findOrFail($id);

        // Update the fuel request information
        $fuel->update($validatedData);

        return Redirect()->route('addaccountingcodedashboard')->with([
            'success' => 'Accounting Code Added Successfully!',
            'name' => $name,
            'user' => $user
        ]);
    }



    // Add Weekly Price for Petroleum Products //
    public function addweeklyfuelpricedashboard()
    {
        $name = "Add Petrol Product Price Dashboard";
        $gasolinestations = GasolineStation::all();

        return view('backend.fuelrequestapproval.addweeklyfuelpricedashboard', compact('name', 'gasolinestations'));
    }

    public function addweeklyfuelpricepage($id)
    {
        $name = "Add Weekly Price";
        $gasolinestation = GasolineStation::findOrFail($id);
        $petroleumproducts = $gasolinestation->petroleumProducts;

        return view('backend.fuelrequestapproval.addweeklyfuelpricepage', compact('name', 'petroleumproducts', 'gasolinestation'));
    }

    // public function addweeklyfuelprice(Request $request)
    // {
    //     $name = "Add Weekly Price";

    //     // Validations
    //     $validatedData = $request->validate([
    //         'accounting_code' => 'required|string'
    //     ]);

    //     $user_id = Auth::id();

    //     // Find the fuel by ID
    //     $fuel = Fuel::findOrFail($id);

    //     // Update the driver information
    //     $fuel->update($validatedData);

    //     return Redirect()->route('addweeklyfuelpricepage')->with([
    //         'success' => 'Weekly Price Added Successfully!',
    //         'name' => $name,
    //     ]);
    // }

    public function addweeklyfuelprice(Request $request, $id)
    {
        $request->validate([
            'products.*.price' => 'nullable|numeric|min:0',
        ]);

        $products = $request->input('products', []);

        foreach ($products as $id => $productData) {
            if (isset($productData['price']) && $productData['price'] !== null) {
                $product = PetroleumProduct::find($id);
                if ($product) {
                    $product->price = $productData['price'];
                    $product->save();
                }
            }
        }

        return redirect()->route('addweeklyfuelpricedashboard')->with('success', 'Fuel prices updated successfully.');
    }



    // List Employees (FOR HR)
    public function allemployees()
    {
        $name = "All Employees";
        $user = auth()->user();
        $employees = Employee::orderBy('lname')->get();

        return view('backend.humanresource.allemployeespage', compact('name', 'employees', 'user'));
    }



    // Add Employee (FOR HR)
    public function addemployeepage()
    {
        $name = "Add Employee";
        $user = auth()->user();
        return view('backend.humanresource.addemployeepage', compact('name', 'user'));
    }

    public function addemployee(Request $request)
    {
        $name = "Add Employee";
        $user = auth()->user();
        // Validations
        // $validateData = $request->validate([
        //     'employee_id' => 'required|string',
        //     'fullname' => 'required|string',
        //     'drivers_license_no' => 'required|string',
        //     'dl_expiration' => 'required|date',
        //     'office' => 'required|string',
        // ]);

        // $user_id = Auth::id();


        Employee::insert([
            'employee_id' => $request->employee_id,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'designation' => $request->designation,
            'office' => $request->office,
            'employment_group' => $request->employment_group,
            'employment_subgroup' => $request->employment_subgroup,
            'department' => $request->department,
            'division' => $request->division,
            'section' => $request->section,
            'contact_no' => $request->contact_no,
            'date_hired' => $request->date_hired,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
            'religion' => $request->religion,
            'citizenship' => $request->citizenship,
            'date_of_birth' => $request->date_of_birth,
            'sss_no' => $request->sss_no,
            'philhealth_no' => $request->philhealth_no,
            'pag_ibig_no' => $request->pag_ibig_no,
            'tin' => $request->tin,
            'image_path' => $request->image_path,
            'created_at' => Carbon::now(),
        ]);

        // $message = 'success';

        return Redirect()->route('addemployeepage')->with([
            'success' => 'Employee Added Successfully!',
            'name' => $name,
            'user' => $user
        ]);
    }


    public function editemployeepage($id)
    {
        $name = "Edit Employee";
        $user = auth()->user();
        $employees = Employee::findOrFail($id);
        return view('backend.humanresource.editemployeepage', compact('name', 'employees', 'user'));
    }

    public function updateemployee(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|string',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'employment' => 'required|string',
            'office' => 'required|string',
            'department' => 'required|string',
            'division' => 'required|string',
            'section' => 'required|string',
            'designation' => 'required|string',
            'contact_no' => 'required|integer',
            'date_hired' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'height' => 'required|string',
            'weight' => 'required|string',
            'blood_type' => 'required|string',
            'address' => 'required|string',
            'religion' => 'required|string',
            'citizenship' => 'required|string',
            'date_of_birth' => 'required|date',
            'sss_no' => 'required|string',
            'philhealth_no' => 'required|string',
            'pag_ibig_no' => 'required|string',
            'tin' => 'required|string',
            'image_path' => 'required|string',
            'created_at' => Carbon::now(),
        ]);

        // Find the driver by ID
        $employees = Employee::findOrFail($id);

        // Update the driver information
        $employees->update($validatedData);

        // Redirect back to the drivers list page
        return redirect()->route('allemployees')->with('updated', 'Driver information updated successfully!');
    }

    public function destroy_employee($id)
    {
        // Find the employee by their ID
        $employee = Employee::findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Redirect back with a success message
        return redirect()->back('allemployees')->with('delete', 'Employee has been deleted successfully.');
    }
}
