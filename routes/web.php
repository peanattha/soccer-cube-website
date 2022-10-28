<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [NavController::class, "showWellcome"])->name("welcome");

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Profile jetstream
$authMiddleware = config('jetstream.guard')
    ? 'auth:' . config('jetstream.guard')
    : 'auth';

Route::group(['middleware' => [$authMiddleware, 'verified']], function () {
    // User & Profile...
    Route::get('/user/profile', [UserProfileController::class, 'show'])
        ->name('profile.show');

    Route::post('/user/profile/bank', [UserProfileController::class, 'bank'])
        ->name('bank');

    Route::post('/user/profile/update_bank/{id}', [UserProfileController::class, 'update_bank'])
        ->name('update_bank');

    Route::post('/user/addAdmin', [UserProfileController::class, 'addAdmin'])
        ->name('addAdmin');

    Route::get('/user/deleteAdmin/{id}', [UserProfileController::class, 'deleteAdmin'])
        ->name('deleteAdmin');
});

//User//
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home', [NavController::class, "showHome"])->name("home");
    Route::get('/stadiums', [NavController::class, "showStadiums"])->name("stadiums");
    Route::get('/reserved', [NavController::class, "showReserved"])->name("reserved");
    Route::get('/cancelReserve/{id}', [NavController::class, "cancelReserve"])->name("cancelReserve");
    Route::get('/reservedFilter', [NavController::class, "showReservedFilter"])->name("reservedFilter");
    Route::get('/stadiumDetail', [NavController::class, "showStadiumDetail"])->name("stadiumDetail");
    Route::post('/insertPayment/{id}', [NavController::class, "insertPayment"])->name("insertPayment");
    Route::get('/payment/{id}', [NavController::class, "showPayment"])->name("payment");
    Route::post('/insertDiscount/{id}', [NavController::class, "insertDiscount"])->name("insertDiscount");
    Route::post('/showConfirm/{id}', [NavController::class, "showConfirm"])->name("showConfirm");
    Route::post('/confirmPayment/{id}', [NavController::class, "confirmPayment"])->name("confirmPayment");
    Route::POST('/dateFilter/{id}', [NavController::class, "dateFilter"])->name("dateFilter");
});

//Admin//
Route::middleware(['auth:sanctum', 'adminAuth'])->group(function () {
    Route::get('/adminDashboard', [NavController::class, "adminDashboard"])->name('adminDashboard');
    Route::get('/adminStadium', [NavController::class, "showAdminStadiums"])->name('stadiumsAdmin');
    Route::get('/editStadium/{id}', [NavController::class, "showEditStadium"])->name('showEditStadium');
    Route::post('/editStadium/{id}', [NavController::class, "editStadium"])->name('editStadium');
    Route::get('/insertStadium', [NavController::class, "showInsertStadium"])->name('showInsertStadium');
    Route::post('/insertStadium', [NavController::class, "insertStadium"])->name('insertStadium');
    Route::get('/deleteStadium/{id}', [NavController::class, "deleteStadium"])->name('deleteStadium');
    Route::get('/cancelReserveAdmin', [NavController::class, "cancelReserveAdmin"])->name('cancelReserveAdmin');
    Route::get('/confirmedCancelAdmin/{id}', [NavController::class, "confirmedCancelAdmin"])->name('confirmedCancelAdmin');
    Route::get('/reserveAdmin', [NavController::class, "showReserveAdmin"])->name('reserveAdmin');
    Route::get('/confirmReserve/{id}', [NavController::class, "confirmReserveAdmin"])->name('confirmReserve');
    Route::get('/dashboardFilter', [NavController::class, "dashboardFilter"])->name("dashboardFilter");
});
