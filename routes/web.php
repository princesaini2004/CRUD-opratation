<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\URL;

URL::forceScheme('http');

Route::get('/', CrudController::class .'@index')->name('Crud.index');
Route::post('/Crud/listJson', [CrudController::class, 'listJson'])->name('Crud.listJson');
Route::get('/posts/create', CrudController::class . '@create')->name('Crud.create');
Route::post('/posts', CrudController::class .'@store')->name('Crud.store');
Route::get('/Details/{Id}', CrudController::class .'@show')->name('Crud.show');
Route::get('/User/{Id}/edit', CrudController::class .'@edit')->name('Crud.edit');
Route::put('/posts/update/{Id}', CrudController::class .'@update')->name('Crud.update');
Route::delete('/DE/{post}', CrudController::class .'@destroy')->name('Crud.destroy');
Route::get('/GetAll', CrudController::class .'@GetAll');
Route::get('/register', CrudController::class .'@register')->name('Crud.register');
Route::get('/login', AuthController::class .'@login')->name('Auth.login');
Route::post('/loginByAuth', AuthController::class .'@loginByAuth')->name('Auth.loginByAuth');

Route::get('/forgot', [ForgotPasswordController::class, 'forgot'])->name('forgot.forgot');
Route::post('/forgot', [ForgotPasswordController::class, 'forgotpass'])->name('forgot.forgotpass');

Route::get('/otpVerify/{id}', [ForgotPasswordController::class, 'otpVerify'])->name('forgot.otpVerify');
Route::post('/otpVerify', [ForgotPasswordController::class, 'otpVerify'])->name('otpVerify');
Route::get('/otpstore', [ForgotPasswordController::class, 'otpstore'])->name('forgot.otpstore');
Route::post('/Verifyotp', [ForgotPasswordController::class, 'Verifyotp'])->name('forgot.Verifyotp');
Route::get('/changeforgot/{id}', [ForgotPasswordController::class, 'changeforgot'])->name('forgot.changeforgot');
Route::post('/changeforgotpass', [ForgotPasswordController::class, 'changeforgotpass'])->name('forgot.changeforgotpass');
Route::get('/change', [ChangePasswordController::class, 'change'])->name('changePassword.change');
Route::post('/changepass', [ChangePasswordController::class, 'changepass'])->name('changePassword.changepass');



















// Route::get('/OtpTemplate', [ForgotPasswordController::class, 'OtpTemplate'])->name('forgot.OtpTemplate');
// Route::get('/Otp', [ForgotPasswordController::class, 'OtpTemplate'])->name('forgot.OtpTemplate');