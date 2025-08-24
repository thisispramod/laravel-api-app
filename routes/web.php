<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});



Route::get('/test-mail', function () {
    Mail::raw('This is a test email from Laravel with Mailtrap!', function ($message) {
        $message->to('test@example.com')
                ->subject('Hello from Mailtrap');
    });

    return "Test mail sent! Check your Mailtrap inbox.";
});
