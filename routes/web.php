<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportDataController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registrationController;

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
    return view('login');
})->name('login_page');

Route::get('/register', function () {
    return view('register');
})->name('registration_page');

Route::get('/dashboard', function () {
    return view('dashboardNew');
})->name('dashboard_page');

Route::get('/forget-password', function () {
    return view('forgetPassword');
})->name('forget_password');

Route::post('/change-password', [loginController::class, 'change_password'])->name('change_password');

Route::post('/login-user', [loginController::class, 'login_user'])->name('create_login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::post('/create-registration', [registrationController::class, 'create_register'])->name('create_register');

// Route::get('/categories', function () {
//     return view('categories');
// })->name('categories');
Route::get('/categories', [loginController::class, 'categories'])->name('categories');
Route::get('/sub-categories/{id}/{name}', [loginController::class, 'subcategories'])->name('sub_categories');
Route::post('/create-subcategory', [loginController::class, 'create_subcategories'])->name('create_subcategories');
Route::get('/delete-subcategories/{id}', [loginController::class, 'destroy_subcategory'])->name('delete_subcategory');
Route::post('/update-subcategories', [loginController::class, 'update_subcategory'])->name('update_subcategory');

Route::post('/update-categories', [loginController::class, 'update_category'])->name('update_category');
Route::get('/delete-categories/{id}', [loginController::class, 'destroy'])->name('delete_category');


Route::post('/create-category', [loginController::class, 'create_category'])->name('create_category');


// Route::post('/import', [ImportDataController::class, 'importCsvData'])->name('import_csv_data');

// Route::get('/', [AccountController::class, 'paintIndex'])->defaults('_config', [
//     'view' => 'new-place.paint.paint',
// ])->name('shop.paint.paint');