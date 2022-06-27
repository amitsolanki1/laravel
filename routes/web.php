<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
// use Illuminate\Support\Facades\Auth;


Route::get('/myaccount',[LoginController::class,'profile'])->middleware('auth');
Route::get('/',function(){
    return redirect('/login');
});
Route::get('/employee',[EmployeeController::Class,'index'])->middleware('auth');
// admin
Route::get('/admin',[AdminController::Class,'index'])->middleware('auth');
Route::get('/admin-employee',[AdminController::Class,'index_employee'])->middleware('auth');
Route::get('/register-admin',[AdminController::Class,'create']);
Route::post('/register-admin',[AdminController::Class,'store']);
Route::get('/edit/{id}',[AdminController::Class,'edit']);
Route::put('/update/{id}',[AdminController::Class,'update']);
Route::get('/view/{id}',[AdminController::Class,'show']);
Route::get('/delete/{id}',[AdminController::Class,'destroy']);
// merchant
Route::get('/merchant',[MerchantController::Class,'index'])->middleware('auth');
Route::get('/register-merchant',[MerchantController::Class,'create']);
Route::post('/register-merchant',[MerchantController::Class,'store']);
Route::get('/merchant/edit/{id}/',[MerchantController::Class,'edit']);
Route::put('/merchant/update/{id}',[MerchantController::Class,'update']);
Route::get('/merchant/view/{id}',[MerchantController::Class,'show']);
Route::delete('merchant/delete/{id}',[MerchantController::Class,'destroy']);
Route::get('/merchant/active/{id}',[MerchantController::class,'active']);
Route::get('/merchant/deactive/{id}',[MerchantController::class,'deactive']);
Route::get('merchant/delete/{id}',[MerchantController::Class,'destroy']);

// login
Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login'])->middleware('web');
// logout
Route::get('/logout',[loginController::class,'logout'])->middleware('auth');
// forget password
Route::get('/forget',[LoginController::class,'forget']);
Route::post('/forget',[LoginController::class,'forget_password'])->name('forget');

Route::get('/reset-forget-password/{email}/{token}',[LoginController::class,'reset_password']);
Route::post('/reset-password',[LoginController::class,'reset'])->name('reset-password');
//->name('reset-forget-password');


Route::get('/active/{id}',[AdminController::class,'active']);
Route::get('/deactive/{id}',[AdminController::class,'deactive']);

Route::get('/back', [LoginController::class,'back']);





