<?php

// Controllers
// use App\Http\Controllers\PurchaseController;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Http\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRController;

use App\Http\Controllers\AdminController;



use App\Http\Controllers\AuditController;
use App\Http\Controllers\LeaveController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/admin', function () {
//     return view('backend/index');
// })->name('admin');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::controller(AdminController::class)->middleware(['auth', 'verified'])->group(function () {

    // Landing Page //
    Route::get('/', 'admin')->name('admin');

    // Reports //
    Route::get("/admin/reports", 'reports')->name('reports');
});



Route::controller(ReportController::class)->middleware(['auth'])->group(function () {

    // Landing Page
    Route::get('/reports', 'reporting')->name('reporting');

    //         // Reports //
    // Route::get("/admin/reports", 'reports')->name('reports');


});



// Route::controller(PurchaseController::class)->middleware(['auth', 'verified'])->group(function () {

//         // Landing Page
//     Route::get('/landing', 'landingpage')->name('landingpage');

//     Route::get('/report/purchasedmaterial/export/', 'exportpurchasedmaterial')->name('exportpurchasedmaterial');

//     Route::get('/report/motorpool/driver/export/', 'exportdriver')->name('exportdriver');

//     Route::get('/report/motorpool/vehicle/export/', 'exportvehicle')->name('exportvehicle');

//     Route::get('/report/motorpool/labortxn/export/', 'exportlabortxn')->name('exportlabortxn');

//     Route::get('/report/motorpool/replacementtxn/export/', 'exportreplacementtxn')->name('exportreplacementtxn');

// });

// Route::controller(PurchaseController::class)->group(function () {
//     Route::get('/pdfviewpage', 'pdfviewpage')->name('pdfviewpage');
// });

// Roles and Permissions Routes
// Route::group(['middleware' => ['role:super-admin|admin']], function() {
Route::group(['middleware' => 'auth', 'role:super-admin'], function () {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});

Route::controller(ReportController::class)->middleware(['auth'])->group(function () {



    // Landing Page
    Route::get('/reports', 'reporting')->name('reporting');


    Route::get('/report/purchasedmaterial/export/', 'exportpurchasedmaterial')->name('exportpurchasedmaterial');

    Route::get('/report/motorpool/driver/export/', 'exportdriver')->name('exportdriver');

    Route::get('/report/motorpool/vehicle/export/', 'exportvehicle')->name('exportvehicle');

    Route::get('/report/motorpool/labortxn/export/', 'exportlabortxn')->name('exportlabortxn');

    Route::get('/report/motorpool/replacementtxn/export/', 'exportreplacementtxn')->name('exportreplacementtxn');

    // Fuel Requisition
    Route::post('/report/fuelrequisition/export/', 'exportfuelrequisition')->name('exportfuelrequisition');
});

// Route::controller(PurchaseController::class)->group(function () {
//     Route::get('/pdfviewpage', 'pdfviewpage')->name('pdfviewpage');
// });

Route::middleware(['auth', 'verified'])
    ->controller(StudentController::class)
    ->group(function () {

        Route::get('/studentdashboard', 'studentdashboard')->name('studentdashboard');

        Route::get('/studentdashboard/studentsemester', 'studentsemester')->name('studentsemester');

        Route::get('/studentreport', 'studentreport')->name('studentreport');

        Route::get('/fetch-student-fullname', [StudentController::class, 'fetchStudentFullName'])->name('fetchStudentFullName');
        Route::get('/fetch-student-details/{studentId}', [StudentController::class, 'fetchStudentDetails'])->name('fetchStudentDetails');

    });

