<?php

namespace App\Http\Controllers;

// Models
use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Purchases;
use Illuminate\Http\Request;


use App\Models\LaborTransaction;
use Spatie\Permission\Models\Role;

// Packages
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Models\PartsReplacementTransaction;
use App\Models\Fuel;
use App\Models\Approval;
use PhpOffice\PhpWord\TemplateProcessor;

class AdminController extends Controller
{
    // // Landing Page
    public function admin(Request $request)
    {

        $user = $request->user();

        // dd($user);

        if ($user->hasRole('hr')) {
            return redirect()->route('motorpool');
        } elseif ($user->hasRole('reg-user')) {
            return redirect()->route('fuelrequisition');
        } elseif ($user->hasRole('corplan') || $user->hasRole('department-heads') || $user->hasRole('general-manager') || $user->hasRole('finance') || $user->hasRole('audit')) {
            return redirect()->route('fuelrequestsdashboard');
        // } elseif ($user->hasRole('audit')) {
        //     return redirect()->route('allmaterials');
        } elseif ($user->hasRole('gm-secretary')) {
            return redirect()->route('downloadfuelrequestsdashboard');
        } elseif ($user->hasRole('accounting-officer')) {
            return redirect()->route('addaccountingcodedashboard');
        } elseif ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            // This part is temporary, I will allow for the meantime the users that has no role to access the admin page, so that I can assign a roles, change this after assigning roles to users in production
            // if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            $name = "Admin Page";
            $user = auth()->user();
            $no_materials = Purchases::count();
            $no_drivers = Driver::count();
            $no_vehicles = Vehicle::count();
            $no_labortransactions = LaborTransaction::count();
            $no_partsreplaced = PartsReplacementTransaction::count();
            $users = User::get();
            $roles = Role::get();
            $permissions = Permission::get();

            return view('backend.index', compact('name', 'no_materials', 'no_drivers', 'no_vehicles', 'no_labortransactions', 'no_partsreplaced', 'roles', 'permissions', 'users', 'user'));
            // }
        }
    }


    // //** Manage Purchased Materials **//

    // // // Landing Page Purchased Material // //
    // public function allmaterials()
    // {
    //     $name = "Purchased Materials";
    //     // $message = "";
    //     $purchases = Purchases::orderBy('created_at', 'desc')->get();

    //     return view('backend.allmaterials', compact('name', 'purchases'));
    // }

    // // // Add Meterial // //
    // public function addmaterialpage()
    // {
    //     $name = "Add Material";
    //     // $message = "";
    //     $departments = [
    //         'CORPLAN - MIS',
    //         'CORPLAN - Audit Section',
    //         'OGM',
    //         'ISD - HR Section',
    //         'ISD - MECP Section',
    //         'ISD - GSS',
    //         'FSD - Billing Section',
    //         'FSD - Tellering Section',
    //         'FSD - Cashiering Section',
    //         'FSD - Accounting Section',
    //         'TSD - Meter Shop Section',
    //         'TSD - Line Services Section',
    //         'TSD - Engineering Section',
    //         'TSD - Warehouse Section',
    //         'AREA'
    //     ];

    //     return view('backend.addmaterial', compact('name', 'departments'));
    // }

    // public function addmaterial(Request $request)
    // {
    //     $name = "Add Purchase";
    //     // Validations
    //     $validateData = $request->validate([
    //         'requisitioner' => 'required|string',
    //         // 'material_code' => 'string',
    //         'material_description' => 'required|string',
    //         // 'brand' => 'string',
    //         // 'model_no' => 'string',
    //         // 'serial_no' => 'string',
    //         // 'supplier' => 'string',
    //         // 'amount' => 'numeric',
    //         'date_of_delivery' => 'required|date',
    //         'issued_to' => 'required|string',
    //         // 'assigned_department' => 'string',
    //         // 'purpose' => 'string',
    //         // 'remarks' => 'string',
    //     ]);

    //     $user_id = Auth::id();

    //     // For MIS Purposes Property Number
    //     $date = new DateTime($request->date_of_delivery);
    //     $formattedDate = $date->format('Y-m');

    //     // Get the last issued control number from the database
    //     $latestPropertyNo = Purchases::latest()->first();

    //     // Extract the series number from the last control number
    //     $lastSeriesNo = ($latestPropertyNo) ? (int)substr($latestPropertyNo->property_no, 8) : 0;

    //     // Increment the series number
    //     $newSeriesNo = $lastSeriesNo + 1;

    //     // Format the new series number as 3 digits
    //     $formattedSeriesNo = sprintf('%03d', $newSeriesNo);

    //     // Concatenate the formatted date and series number
    //     $property_no = $formattedDate . '-' . $formattedSeriesNo;


    //     Purchases::insert([
    //         'requisitioner' => $request->requisitioner,
    //         'material_code' => $request->material_code,
    //         'material_description' => $request->material_description,
    //         'brand' => $request->brand,
    //         'model_no' => $request->model_no,
    //         'serial_no' => $request->serial_no,
    //         'property_no' => $property_no,
    //         'supplier' => $request->supplier,
    //         'amount' => $request->amount,
    //         'user_id' => $user_id,
    //         'date_paid' => $request->date_of_purchase,
    //         'date_of_delivery' => $request->date_of_delivery,
    //         'issued_to' => $request->issued_to,
    //         'assigned_department' => $request->assigned_department,
    //         'purpose' => $request->purpose,
    //         'remarks' => $request->remarks,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // $message = 'success';

    //     return Redirect()->route('allmaterials')->with([
    //         'success' => 'Material Added Successfully!',
    //         'name' => $name
    //     ]);
    // }

    // // // Update Material Information // //
    // public function editmaterialpage($id)
    // {
    //     $name = "Edit Material";
    //     // $message = "";
    //     $material = Purchases::find($id);

    //     $departments = [
    //         'CORPLAN - MIS',
    //         'CORPLAN - Audit Section',
    //         'OGM',
    //         'ISD - HR Section',
    //         'ISD - MECP Section',
    //         'ISD - GSS',
    //         'FSD - Billing Section',
    //         'FSD - Tellering Section',
    //         'FSD - Cashiering Section',
    //         'FSD - Accounting Section',
    //         'TSD - Meter Shop Section',
    //         'TSD - Line Services Section',
    //         'TSD - Engineering Section',
    //         'TSD - Warehouse Section',
    //         'AREA'
    //     ];

    //     $currentdept = $material->assigned_department;
    //     $index = array_search($currentdept, $departments);

    //     if ($index !== false) {
    //         unset($departments[$index]);
    //     }

    //     return view('backend.editmaterial', compact('name', 'material', 'departments'));
    // }

    // public function updatematerial(Request $request, $id)
    // {

    //     $validateData = $request->validate([
    //         'requisitioner' => 'required|string',
    //         // 'material_code' => 'string',
    //         'material_description' => 'required|string',
    //         // 'brand' => 'string',
    //         // 'model_no' => 'string',
    //         // 'serial_no' => 'string',
    //         // 'supplier' => 'string',
    //         // 'amount' => 'numeric',
    //         'date_of_delivery' => 'required|date',
    //         'issued_to' => 'required|string',
    //         // 'assigned_department' => 'string',
    //         // 'purpose' => 'string',
    //         // 'remarks' => 'string',
    //     ]);


    //     Purchases::find($id)->update([
    //         'requisitioner' => $request->requisitioner,
    //         'material_code' => $request->material_code,
    //         'material_description' => $request->material_description,
    //         'brand' => $request->brand,
    //         'model_no' => $request->model_no,
    //         'serial_no' => $request->serial_no,
    //         'supplier' => $request->supplier,
    //         'amount' => $request->amount,
    //         'date_of_delivery' => $request->date_of_delivery,
    //         'issued_to' => $request->issued_to,
    //         'assigned_department' => $request->assigned_department,
    //         'purpose' => $request->purpose,
    //         'remarks' => $request->remarks,
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     return Redirect()->back()->with('success', 'Material Updated Successfully!');
    // }

    // // // Delete Purchased Material // //
    // public function deletematerial($id)
    // {

    //     $name = "Delete Material";

    //     Purchases::find($id)->delete();

    //     return Redirect()->back()->with("deleted", "Material deleted successfully!");
    // }


    //                 //** Manage Purchased Materials **//

    // // // Landing Page Motorpool Info System // //
    // public function motorpool() {
    //     $name = "Motorpool Information";
    //     // $message = "";
    //     $drivers = Driver::orderBy('created_at', 'desc')->get();;
    //     $vehicles = Vehicle::orderBy('created_at', 'desc')->get();;

    //     return view('backend.motorpool', compact('name','drivers', 'vehicles'));
    // }

    // // //------ All Drivers ------// //
    // public function alldrivers() {
    //     $name = "All Drivers";
    //     $drivers = Driver::orderBy('created_at', 'desc')->get();

    //     return view('backend.alldrivers', compact('name', 'drivers'));
    // }

    // // // Add Driver // //
    // public function adddriverpage() {
    //     $name = "Add Driver";
    //     return view('backend.adddriverpage', compact('name'));
    // }

    // public function adddriver(Request $request) {
    //     $name = "Add Driver";
    //     // Validations
    //     $validateData = $request->validate([
    //         'employee_id' => 'required|string',
    //         'fullname' => 'required|string',
    //         'drivers_license_no' => 'required|string',
    //         'dl_expiration' => 'required|date',
    //         'office' => 'required|string',
    //     ]);

    //     // $user_id = Auth::id();


    //     Driver::insert([
    //         'employee_id' => $request->employee_id,
    //         'fullname' => $request->fullname,
    //         'drivers_license_no' => $request->drivers_license_no,
    //         'dl_expiration' => $request->dl_expiration,
    //         'office' => $request->office,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // $message = 'success';

    //     return Redirect()->route('adddriverpage')->with([
    //         'success' => 'Driver Added Successfully!',
    //         'name' => $name
    //     ]);
    // }

    // // // Update Driver Information
    // public function editdriver($id) {
    //     $name = "Edit Driver";
    //     $driver = Driver::findOrFail($id);
    //     return view('backend.editdrivers', compact('name', 'driver'));
    // }

    // public function updatedriver(Request $request, $id) {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'employee_id' => 'required|string',
    //         'fullname' => 'required|string',
    //         'drivers_license_no' => 'required|string',
    //         'dl_expiration' => 'required|date',
    //         'office' => 'required|string',
    //     ]);

    //     // Find the driver by ID
    //     $driver = Driver::findOrFail($id);

    //     // Update the driver information
    //     $driver->update($validatedData);

    //     // Redirect back to the drivers list page
    //     return redirect()->route('motorpool')->with('success', 'Driver information updated successfully!');
    // }

    // // // Delete Driver
    // public function deletedriver($id) {
    //     // Find the driver by ID
    //     // $driver = Driver::findOrFail($id);

    //     Driver::find($id)->delete();

    //     // Delete the driver
    //     // $driver->delete();

    //     // Redirect back to the drivers list page
    //     return redirect()->route('motorpool')->with('success', 'Driver deleted successfully!');
    // }


    // // //------ All Vehicles ------// //
    // public function allvehicles() {
    //     $name = "All Vehicles";
    //     $vehicles = Vehicle::orderBy('created_at', 'desc')->get();

    //     return view('backend.allvehicles', compact('name', 'vehicles'));
    // }

    // // // Add Vehicle // //
    // public function addvehiclepage() {
    //     $name = "Add Vehicle";
    //     $drivers = Driver::orderBy('created_at', 'desc')->get();

    //     return view('backend.addvehiclepage', compact('name', 'drivers'));
    // }

    // public function addvehicle(Request $request) {
    //     $name = "Add Vehicle";
    //     // Validations
    //     $validateData = $request->validate([
    //         'plate_no' => 'required|string',
    //         'vehicle_description' => 'required|string',
    //         'vehicle_brand' => 'required|string',
    //         'engine_no' => 'required|string',
    //         'chassis_no' => 'required|string',
    //         'or' => 'required|date',
    //         'cr_no' => 'required|string',
    //         'cr_expiration' => 'required|date',
    //         'driver_id' => 'required|integer',
    //         'department' => 'required|string',
    //         'office' => 'required|string',
    //     ]);

    //     // $user_id = Auth::id();


    //     Vehicle::insert([
    //         'plate_no' => $request->plate_no,
    //         'vehicle_description' => $request->vehicle_description,
    //         'vehicle_brand' => $request->vehicle_brand,
    //         'engine_no' => $request->engine_no,
    //         'chassis_no' => $request->chassis_no,
    //         'or' => $request->or,
    //         'cr_no' => $request->cr_no,
    //         'cr_expiration' => $request->cr_expiration,
    //         'driver_id' => $request->driver_id,
    //         'department' => $request->department,
    //         'office' => $request->office,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // $message = 'success';

    //     return Redirect()->route('addvehiclepage')->with([
    //         'success' => 'Vehicle Added Successfully!',
    //         'name' => $name
    //     ]);
    // }

    // // // Update Vehicle Information // //
    // public function editvehicle($id) {
    //     $name = "Edit Vehicle";
    //     $vehicle = Vehicle::findOrFail($id);
    //     // Fetch drivers from the database
    //     $drivers = Driver::all();
    //     return view('backend.editvehicle', compact('name', 'vehicle', 'drivers'));
    // }

    // public function updatevehicle(Request $request, $id) {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'driver_id' => 'required|integer',
    //         'or' => 'required|date',
    //         'cr_no' => 'required|string',
    //         'cr_expiration' => 'required|date',
    //         'department' => 'required|string',
    //         'office' => 'required|string',
    //     ]);

    //     // Find the driver by ID
    //     $vehicle = Vehicle::findOrFail($id);

    //     // Update the driver information
    //     $vehicle->update($validatedData);

    //     // Redirect back to the motorpool list page
    //     return redirect()->route('motorpool')->with('success', 'Vehicle information updated successfully!');
    // }

    // // // Delete Vehicle // //
    // public function deleteVehicle($id) {
    //     // Find the vehicle by ID
    //     // $vehicle  = Vehicle ::findOrFail($id);

    //     Vehicle ::find($id)->delete();

    //     // Delete the vehicle
    //     // $vehicle ->delete();

    //     // Redirect back to the motorpool  list page
    //     return redirect()->route('motorpool')->with('success', 'Vehicle  deleted successfully!');
    // }


    // // //------ All Labor Transactions ------// //
    // public function alllabor() {
    //     $name = "Labor Transactions";
    //     $drivers = Driver::orderBy('created_at', 'desc')->get();
    //     $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
    //     $laborTransactions = LaborTransaction::orderBy('created_at', 'desc')->get();

    //     return view('backend.alllabor', compact('name', 'drivers', 'vehicles', 'laborTransactions'));
    // }

    // // // Add Labor // //
    // public function addlaborpage() {
    //     $name = "Add Labor Transaction";
    //     $drivers = Driver::all();
    //     $vehicles = Vehicle::all();

    //     return view('backend.addlabortxnpage', compact('name', 'drivers', 'vehicles'));
    // }

    // public function addlabor(Request $request) {
    //     $name = "Add Labor Transaction";
    //     // Validations
    //     $validatedData = $request->validate([
    //         'type_of_labor' => 'required|string',
    //         'shop_mechanic' => 'required|string',
    //         'or_no' => 'required|string',
    //         'date_of_labor' => 'required|date',
    //         'odometer' => 'integer',
    //         'driver_id' => 'required|string',
    //         'vehicle_id' => 'required|string',
    //         'amount' => 'string',
    //         'remarks' => 'string',
    //     ]);

    //     // $user_id = Auth::id();


    //     LaborTransaction::insert([
    //         'type_of_labor' => $request->type_of_labor,
    //         'shop_mechanic' => $request->shop_mechanic,
    //         'or_no' => $request->or_no,
    //         'date_of_labor' => $request->date_of_labor,
    //         'odometer' => $request->odometer,
    //         'driver_id' => $request->driver_id,
    //         'vehicle_id' => $request->vehicle_id,
    //         'amount' => $request->amount,
    //         'remarks' => $request->remarks,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // $message = 'success';

    //     return Redirect()->route('alllabor')->with([
    //         'success' => 'Labor Transaction Added Successfully!',
    //         'name' => $name
    //     ]);
    // }

    // // // Update Labor Transaction Information // //
    // public function editlabor($id) {
    //     $name = "Edit Labor Transaaction";
    //     $labortxn = LaborTransaction::findOrFail($id);
    //     $vehicle = Vehicle::findOrFail($labortxn->vehicle_id);
    //     $driver = Driver::findOrFail($labortxn->driver_id);

    //     $drivers = Driver::orderBy('created_at', 'desc')->get();
    //     return view('backend.editlabortxn', compact('name', 'vehicle', 'driver', 'labortxn'));
    // }

    // public function updatelabor(Request $request, $id) {
    //     // Validate the request data

    //     $validatedData = $request->validate([
    //         'type_of_labor' => 'required|string',
    //         'shop_mechanic' => 'required|string',
    //         'or_no' => 'required|string',
    //         'date_of_labor' => 'required|date',
    //         'odometer' => 'integer',
    //         'amount' => 'required|numeric',
    //         // 'remarks' => 'string',
    //     ]);

    //     error_log("type_of_labor: ".$request->type_of_labor);
    //     error_log("shop_mechanic: ".$request->shop_mechanic);
    //     error_log("or_no: ".$request->or_no);
    //     error_log("date_of_labor: ".$request->date_of_labor);
    //     error_log("odometer: ".$request->odometer);
    //     error_log("amount: ".$request->amount);
    //     error_log("remarks: ".$request->remarks);
    //     error_log("driver_id: ".$request->driver_id);
    //     error_log("vehicle_id: ".$request->vehicle_id);

    //     LaborTransaction::find($id)->update([
    //         'type_of_labor' => $request->type_of_labor,
    //         'shop_mechanic' => $request->shop_mechanic,
    //         'or_no' => $request->or_no,
    //         'date_of_labor' => $request->date_of_labor,
    //         'odometer' => $request->odometer,
    //         'driver_id' => $request->driver_id,
    //         'vehicle_id' => $request->vehicle_id,
    //         'amount' => $request->amount,
    //         'remarks' => $request->remarks,
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     // Redirect back to the motorpool list page
    //     return redirect()->route('alllabor')->with('success', 'Labor Transaction updated successfully!');
    // }


    // // //------ All Labor Transactions ------// //
    // public function allpartsreplacement() {
    //     $name = "Parts Replacement Transactions";

    //     $partsreplacementtxns = PartsReplacementTransaction::orderBy('created_at', 'desc')->get();

    //     return view('backend.allpartsreplacement', compact('name', 'partsreplacementtxns'));
    // }


    // // // Add Parts Replacement // //
    // public function addreplacementpage() {
    //     $name = "Add Parts Replacement";
    //     $drivers = Driver::all();
    //     $vehicles = Vehicle::all();

    //     return view ('backend.addpartsreplacedtxnpage', compact('name', 'drivers', 'vehicles'));
    // }

    // public function addreplacement(Request $request) {
    //     $name = "Add Parts Replacement Transaction";
    //     // Validations
    //     $validatedData = $request->validate([
    //         'parts_replaced' => 'required|string',
    //         'shop_supplier' => 'required|string',
    //         'or_no' => 'required|string',
    //         'date_of_replacement' => 'required|date',
    //         'odometer' => 'required|string',
    //         'driver_id' => 'required|string',
    //         'vehicle_id' => 'required|string',
    //         'amount' => 'required|numeric',
    //         'remarks' => 'required|string',
    //     ]);

    //     // $user_id = Auth::id();


    //     PartsReplacementTransaction::insert([
    //         'parts_replaced' => $request->parts_replaced,
    //         'shop_supplier' => $request->shop_supplier,
    //         'or_no' => $request->or_no,
    //         'date_of_replacement' => $request->date_of_replacement,
    //         'odometer' => $request->odometer,
    //         'driver_id' => $request->driver_id,
    //         'vehicle_id' => $request->vehicle_id,
    //         'amount' => $request->amount,
    //         'remarks' => $request->remarks,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     // $message = 'success';

    //     return Redirect()->route('allpartsreplacement')->with([
    //         'success' => 'Part Replacement Transaction Added Successfully!',
    //         'name' => $name
    //     ]);
    // }


    // // // Update Parts Replacement Transaction // //
    // public function editpartsreplacement($id) {
    //     $name = "Edit Parts Replacement Transaaction";
    //     $partsreplacementtxn = PartsReplacementTransaction::findOrFail($id);
    //     $vehicle = Vehicle::findOrFail($partsreplacementtxn->vehicle_id);
    //     $driver = Driver::findOrFail($partsreplacementtxn->driver_id);

    //     return view('backend.editpartsreplacementtxn', compact('name', 'vehicle', 'driver', 'partsreplacementtxn'));
    // }

    // public function updatepartsreplacement(Request $request, $id) {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'parts_replaced' => 'required|string',
    //         'shop_supplier' => 'required|string',
    //         'or_no' => 'required|string',
    //         'date_of_replacement' => 'required|date',
    //         'odometer' => 'integer',
    //         'amount' => 'required|numeric',
    //         // 'remarks' => 'string',
    //     ]);

    //     // error_log("type_of_labor: ".$request->type_of_labor);
    //     // error_log("shop_mechanic: ".$request->shop_mechanic);
    //     // error_log("or_no: ".$request->or_no);
    //     // error_log("date_of_labor: ".$request->date_of_labor);
    //     // error_log("odometer: ".$request->odometer);
    //     // error_log("amount: ".$request->amount);
    //     // error_log("remarks: ".$request->remarks);
    //     // error_log("driver_id: ".$request->driver_id);
    //     // error_log("vehicle_id: ".$request->vehicle_id);

    //     PartsReplacementTransaction::find($id)->update([
    //         'parts_replaced' => $request->parts_replaced,
    //         'shop_supplier' => $request->shop_supplier,
    //         'or_no' => $request->or_no,
    //         'date_of_replacement' => $request->date_of_replacement,
    //         'odometer' => $request->odometer,
    //         'driver_id' => $request->driver_id,
    //         'vehicle_id' => $request->vehicle_id,
    //         'amount' => $request->amount,
    //         'remarks' => $request->remarks,
    //         'updated_at' => Carbon::now(),
    //     ]);

    //     // Redirect back to the motorpool list page
    //     return redirect()->route('allpartsreplacement')->with('success', 'Parts Replacement Transactions updated successfully!');
    // }

// }


}


