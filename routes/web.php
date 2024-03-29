<?php

use App\Http\Livewire\PosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CoinsController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\PermissionsController;
use App\Http\Controllers\ExportPdfController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('categories', CategoriesController::class);
Route::get('products', ProductsController::class);
Route::get('denominations', CoinsController::class);
Route::get('pos', PosController::class);
Route::get('roles', RolesController::class);
Route::get('permisos', PermissionsController::class);
Route::get('asignar', AsignarController::class);
Route::get('users', UsersController::class);
Route::get('cashouts', CashoutController::class);
Route::get('reports', ReportsController::class);

Route::get('report/pdf/{user}/{type}/{f1}/{f2}',[ExportPdfController::class, 'reportPdf']);
Route::get('report/pdf/{user}/{type}',[ExportPdfController::class, 'reportPdf']);

Route::get('report/excel/{user}/{type}/{f1}/{f2}',[ExportPdfController::class, 'reportExcel']);
Route::get('report/excel/{user}/{type}',[ExportPdfController::class, 'reportExcel']);
