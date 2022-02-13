<?php

use App\Http\Controllers\AccountCategoryController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\TransactionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('category')->group(function(){
    
    Route::prefix('expense')->controller(ExpenseCategoryController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('/{expense_category}', 'show');
        Route::post('/', 'store');
        Route::put('/{expense_category}', 'update');
    });

    Route::prefix('income')->controller(IncomeCategoryController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('/{income_category}', 'show');
        Route::post('/', 'store');
        Route::put('/{income_category}', 'update');
    });

    Route::prefix('account')->controller(AccountCategoryController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('/{account_category}', 'show');
        Route::post('/', 'store');
        Route::put('/{account_category}', 'update');
    });

});

Route::prefix('transaction')->controller(TransactionController::class)->group(function(){
    Route::post('/income/{account_category}/{income_category}', 'setIncome');
    Route::post('/expense/{income_category}/{expense_category}', 'setExpense');
});

Route::prefix('account')->controller(AccountController::class)->group(function(){
    Route::get('/', 'index');
});
