<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;

use Illuminate\Support\Facades\Auth;

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

// Halaman utama
Route::get('/', function () {
    return view('index');
})->name('home');
// Halaman fitur
Route::get('/fitur', function () {
    return view('fitur');
})->name('fitur');
// Halaman cara kerja
Route::get('/caraKerja', function () {
    return view('caraKerja');
})->name('caraKerja');


// Authentikasi (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// Logout (Authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Halaman Report (Hanya untuk User)
Route::middleware(['auth'])->group(function () {
    // Route Home untuk masing-masing role
    Route::get('/user/home', [ReportController::class, 'index'])->name('user.home');
    Route::get('/admin/home', [\App\Http\Controllers\AdminController::class, 'home'])->name('admin.home')->middleware('role:admin');

    //Route untuk halaman profile admin
    Route::get('/admin/profile', [\App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile')->middleware('role:admin');
    Route::post('/admin/profile', [\App\Http\Controllers\AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('role:admin');
    Route::post('/admin/password', [\App\Http\Controllers\AdminController::class, 'updatePassword'])->name('admin.password.update')->middleware('role:admin');
    
    //Route untuk halaman laporan admin
    Route::get('/admin/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports')->middleware('role:admin');
    Route::get('/admin/history', [\App\Http\Controllers\AdminController::class, 'history'])->name('admin.history')->middleware('role:admin');

    Route::get('/report', [ReportController::class, 'index'])->name('reports.index');
    Route::resource('reports', ReportController::class)->except(['index']);

    // Route untuk Klaim/Hubungi
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/admin/claims', [ClaimController::class, 'index'])->name('admin.claims')->middleware('role:admin');
    Route::patch('/admin/claims/{id}', [ClaimController::class, 'updateStatus'])->name('admin.claims.update')->middleware('role:admin');

});

//untuk user mengakses ke halaman history
Route::get('/user/history', [\App\Http\Controllers\UserController::class, 'history'])->name('user.history')->middleware('auth');
//untuk user mengakses ke halaman profile
Route::get('/user/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('/user/profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.profile.update')->middleware('auth');
Route::post('/user/password', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');



// Contoh route dengan CheckRole (jika diperlukan)
// Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'role:admin']);