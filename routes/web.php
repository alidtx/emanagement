<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DesignationWiseAmountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
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

Route::get('/', function () {
    return view('auth.login');
});


// SSLCOMMERZ Start
Route::get('/checkout/{event_code}', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/checkout2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']); 
Route::post('/event_code', [SslCommerzPaymentController::class, 'EventCode'])->name('event_code'); 
Route::post('/ssl-pay/{code}', [SslCommerzPaymentController::class, 'index'])->name('payment_page');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay-via-ajax');
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



Auth::routes();


Route::get('/curl', [EventController::class, 'curl'])->name('event.list');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {;
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/user_delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_delete');
    Route::get('/role_delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role_delete');
    #profile
    Route::get('/profile-show', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile_store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile_store');
    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'change_password_view'])->name('change_password');
    Route::post('/change-password/store', [App\Http\Controllers\HomeController::class, 'change_password'])->name('change_password_update');
    
    Route::get('/settings', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('mark-as-read-all-notifications', [App\Http\Controllers\HomeController::class, 'marAllAsRead'])->name('marAllAsRead');
    
    #Employees

    Route::prefix('employees')->group(function () {
        Route::get('/list', [EmployeeController::class, 'index'])->name('employees.list');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');  
        Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::get('/status/{status}/{id}', [EmployeeController::class, 'status'])->name('employees.status');
    });

    #event
    Route::prefix('event')->group(function () {
        Route::get('/list', [EventController::class, 'index'])->name('event.list');
        Route::get('/create', [EventController::class, 'create'])->name('event.create');  
        Route::post('/store', [EventController::class, 'store'])->name('event.store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::post('/update/{id}', [EventController::class, 'update'])->name('event.update');
        Route::get('/status/{status}/{id}', [EventController::class, 'status'])->name('event.delete');
    });

    #Designation
    Route::prefix('designation')->group(function () {
        Route::get('/list', [DesignationController::class, 'index'])->name('designation.list');
        Route::get('/create', [DesignationController::class, 'create'])->name('designation.create');  
        Route::post('/store', [DesignationController::class, 'store'])->name('designation.store');
        Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
        Route::post('/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
        Route::get('/status/{status}/{id}', [DesignationController::class, 'status'])->name('designation.status');
    });

   #Expense
    Route::prefix('expense')->group(function () {
        Route::get('/list', [ExpenseController::class, 'index'])->name('expense.list');
        Route::get('/create', [ExpenseController::class, 'create'])->name('expense.create');  
        Route::post('/store', [ExpenseController::class, 'store'])->name('expense.store');
        Route::get('/edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
        Route::post('/update/{id}', [ExpenseController::class, 'update'])->name('expense.update');
        Route::get('/status/{status}/{id}', [ExpenseController::class, 'status'])->name('expense.delete');
    });

    Route::prefix('department')->group(function () {
        Route::get('/list', [DepartmentController::class, 'index'])->name('department.list');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');  
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::get('/status/{status}/{id}', [DepartmentController::class, 'status'])->name('department.status');
    });


    Route::prefix('payment')->group(function () {
        Route::get('/list', [PaymentController::class, 'index'])->name('payment.list');
        Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');  
        Route::post('/store', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
        Route::get('/status/{status}/{id}', [PaymentController::class, 'status'])->name('payment.status');
    });
});




