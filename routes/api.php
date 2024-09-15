<?php

use App\Modules\Companies\Presentation\Controllers\CompanyController;
use App\Modules\Invoices\Presentation\InvoiceController;
use App\Modules\Products\Presentation\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
Route::patch('/invoices/{id}/approve', [InvoiceController::class, 'approve']);
Route::patch('/invoices/{id}/reject', [InvoiceController::class, 'reject']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/companies/{id}', [CompanyController::class, 'show']);
