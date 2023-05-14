<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [ProductController::class, 'index'])->name('index');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'isAdmin'])->name('dashboard');

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return redirect('/');
})->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//About us
Route::get('/about-us', [PageControlleroller::class, 'about_us']);
require __DIR__.'/auth.php';
//Contact
Route::get('/contact', [PageController::class, 'contact']);
// Search
Route::get('search', [ProductController::class, 'getSearch'])->name('search');
