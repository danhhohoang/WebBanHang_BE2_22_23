<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailsController;
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
// Add products to cart
Route::get('add-to-cart/{id}', [ProductController::class, 'getAddToCart'])->name('product.addToCart');
Route::get('shopping-cart', [ProductController::class, 'getCart'])->name('shoppingCart');
// Add to cart form page ShopDetails and ShopGrid
Route::get('{detailGrid?}/add-to-cart/{id}', [ProductController::class, 'addToCartDetailGrid'])->name('addToCart');
Route::get('/shop-details/{id}', [ProductDetailsController::class, 'product_detail'])->name('shop.details');
Route::get('{mul?}/add-to-cart-mul/{id}/{quantity}', [ProductController::class, 'addToCartMul']);

//Transaction history
Route::get('transaction-history', [ProductController::class, 'transactionHistory'])->name('transactionHistory');
Route::get('transaction-detail/{id}', [ProductController::class, 'transactionDetail'])->name('transactionDetail');
// Search
Route::get('search', [ProductController::class, 'getSearch'])->name('search');
//Get product by type_ID
Route::get('/shop-grid/{typeid?}', [ProductController::class, 'drid']);
// Xoa san pham ra gio hang
Route::get('delete-to-cart/{id}', [ProductController::class, 'deleteItemCart']);
//Cap nhat tat ca san pham
Route::post('save-all', [ProductController::class, 'saveAllItemCart']);
//About us
Route::get('/about-us', [PageController::class, 'about_us']);
//Checkout
Route::get('checkout', [ProductController::class, 'checkOut'])->name('checkOut');
Route::post('save-checkout', [ProductController::class, 'saveCheckOut'])->name('saveCheckOut');