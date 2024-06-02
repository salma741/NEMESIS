<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CheckStatusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MemberPackageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::controller(AuthController::class)->group(function() {
    Route::get('auth', 'index')->name('login');
    Route::post('login', 'login');
    Route::post('register', 'register')->name('register');
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
});

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');
Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');



// Normal Users Route List
Route::middleware(['auth', 'user-access:member'])->group(function () {
   
});

// Normal Admin Route List
Route::middleware(['auth', 'user-access:super admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/dashboard', [ContactController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('/user', UserController::class);
    Route::resource('/check-status', CheckStatusController::class);
    Route::resource('member-package', MemberPackageController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('registration', RegistrationController::class);
    Route::resource('trainer', TrainerController::class);
    Route::resource('supplement', SupplementController::class);
    Route::resource('carousel', CarouselController::class);
    Route::resource('map', MapController::class);
    Route::resource('contact-us', ContactController::class);
});

Route::middleware(['auth', 'admin-access:admin'])->group(function () {
    // Route::resource('check-status', CheckStatusController::class);
    // Route::resource('registration', RegistrationController::class);
    // Route::resource('contact', ContactController::class);
});
