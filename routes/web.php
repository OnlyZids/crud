<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudController; 


Route::get('/', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 

Route::middleware(['auth'])->group(function () {
    // ini untuk Member VIP
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); 
    
    // ini untuk user Admin
    Route::resource('users', UserController::class);


    Route::prefix('crud')->name('crud.')->group(function () { 
        Route::get('/', [CrudController::class, 'index'])->name('index'); 
        Route::get('/create', [CrudController::class, 'create'])->name('create'); 
        Route::post('/store', [CrudController::class, 'store'])->name('store'); 
        Route::get('/edit/{id}', [CrudController::class, 'edit'])->name('edit'); 
        Route::post('/update/{id}', [CrudController::class, 'update'])->name('update'); 
        Route::get('/delete/{id}', [CrudController::class, 'delete'])->name('delete'); 



    });

});
