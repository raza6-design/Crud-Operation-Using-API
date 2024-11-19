<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LibrarieController;


// route::resource('/user',UserController::class); 
route::view('/','home')->name('home');
route::view('/addpost','addpost');
route::view('/updatepost','update');
route::view('/viewpost','view');
route::view('/dashboard','dashboard');


route::view('registerpage','register')->name('Register');
route::post('registersave',[UserController::class,'register'])->name('registersave');
Route::get('/loginpage',function () {
    return view('login');
})

// route::view('loginpage','Login')->name('Login');
// route::post('loginMatch',[UserController::class,'login'])->name('loginMatch');

// route::get('dashboard',[UserController::class,'dashboardPage'])->name('dashboard');
// route::get('logout',[UserController::class,'Logout'])->name('logout');
// route::get('dashboard/inner',[UserController::class,'innerPage'])->name('inner');



?>
