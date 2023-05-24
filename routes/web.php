<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminProtypeController;
use App\Http\Controllers\AdminRatingController;
use App\Http\Controllers\AdminUser;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\NewsletterController;
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

// Them san pham vao gio hang
Route::get('add-to-cart/{id}', [ProductController::class, 'getAddToCart'])->name('product.addToCart');
Route::get('shopping-cart', [ProductController::class, 'getCart'])->name('shoppingCart');

// Xoa san pham ra gio hang
Route::get('delete-to-cart/{id}', [ProductController::class, 'deleteItemCart']);
//Cap nhat tat ca san pham
Route::post('save-all', [ProductController::class, 'saveAllItemCart']);
//Checkout
Route::get('checkout', [ProductController::class, 'checkOut'])->name('checkOut');
Route::post('save-checkout', [ProductController::class, 'saveCheckOut'])->name('saveCheckOut');

//Transaction history
Route::get('transaction-history', [ProductController::class, 'transactionHistory'])->name('transactionHistory');
Route::get('transaction-detail/{id}', [ProductController::class, 'transactionDetail'])->name('transactionDetail');
Route::prefix('/dashboard')->middleware('auth', 'isAdmin')->group(function () {
    //View all orders of Admin
    Route::get('orders', [OrdersController::class, 'index'])->name('admin-view-orders');
    //View new order
    Route::get('new-orders', [DashboardController::class, 'path_vienewOder'])->name('admin-view-new-order');
    //get from add user
    Route::get('user/adduser', function () {
        return view('admin.admin-addUser');
    })->name('user.add');

    //get from edit user
    Route::get('user/edit/{id}', [AdminUser::class, 'edit'])->name('admin.edituser');

    //update user
    Route::put('protype/update', [AdminUser::class, 'update'])->name('admin.updateuser');

    //get from list product
    Route::get('product', [AdminProductController::class, 'product'])->name('admin.listproduct');

    //get from add product
    Route::get('product/add', [AdminProductController::class, 'add'])->name('admin.addproduct');

    // add product
    Route::post('product/add', [AdminProductController::class, 'addproduct'])->name('product.add');

    //get from edit product
    Route::get('product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.editproduct');

    //get update product
    Route::put('product/edit', [AdminProductController::class, 'update'])->name('product.update');


    //Delete user
    Route::delete('product/{product}', [AdminProductController::class, 'destroy'])->name('delete.product');

    //get list email newsletter 
    Route::get('email-newsletter', [EmailController::class, 'getAllEmails'])->name('email-letter');

    //Delete email newsletter
    Route::delete('email-newsletter/{email}', [EmailController::class, 'destroy'])->name('admin.delete-email-letter');

    //get list protype
    Route::get('protype', [AdminProtypeController::class, 'protype'])->name('admin.listprotype');

    
    //get from add protype
    Route::get('protype/addprotype', function () {
        return view('admin.admin-addprotype');
    })->name('protype.add');

    //get from edit protype
Route::get('protype/edit/{id}', [AdminProtypeController::class, 'edit'])->name('admin.editprotype');

//update protype
Route::put('protype/update/{id}', [AdminProtypeController::class, 'update'])->name('admin.update');

//Delete protype
Route::delete('protype/{protype}', [AdminProtypeController::class, 'destroy'])->name('admin.protype');

//get from list user
Route::get('user', [AdminUser::class, 'user'])->name('admin.listuser');

//Delete user
Route::delete('user/{user}', [AdminUser::class, 'destroy'])->name('admin.user');

//add user
Route::post('user/add', [AdminUser::class, 'add'])->name('admin.adduser');
  
//View rating of admin
Route::get('rating', [AdminRatingController::class, 'index'])->name('admin-view-rating');

//Delete rating
Route::delete('rating/delete/{id}', [AdminRatingController::class, 'destroy'])->name('admin-delete-rating');

//View all orders of Admin
Route::get('orders', [OrdersController::class, 'index'])->name('admin-view-orders');

//View details orders of admin
Route::get('orders/{id}', [OrdersController::class, 'find'])->name('admin-view-details-order');

//Delete email newsletter
Route::delete('email-newsletter/{email}', [EmailController::class, 'destroy'])->name('admin.delete-email-letter');

Route::get('email-newsletter/send-all-email', function () {
    return view('admin-send-all-mails');
})->name('form-send-all-emails');

//Send all emails
Route::post('sendAllMails', [SendEmailController::class, 'send_all'])->name('admin-send-all-email');

//View form send 1 email
Route::get('email-newsletter/send-email/{email}', [EmailController::class, 'find'])->name('form-send-emails');

//Send 1 email
Route::post('sendMail', [SendEmailController::class, 'send'])->name('admin-send-email');
});
//add protype
Route::post('/protype/add', [AdminProtypeController::class, 'add'])->name('admin.addprotype');





//About us
Route::get('/about-us', [PageControlleroller::class, 'about_us']);
require __DIR__ . '/auth.php';
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
//Get product by type_ID
Route::get('/shop-grid/{typeid?}', [ProductController::class, 'drid']);
// Xoa san pham ra gio hang
Route::get('delete-to-cart/{id}', [ProductController::class, 'deleteItemCart']);
//Cap nhat tat ca san pham
Route::post('save-all', [ProductController::class, 'saveAllItemCart']);
//About us
Route::get('/about-us', [PageController::class, 'about_us']);
//newsletter
Route::post('/newsletter', [ProductController::class, 'storeEmail'])->name('email.store');
//Checkout
Route::get('checkout', [ProductController::class, 'checkOut'])->name('checkOut');
Route::post('save-checkout', [ProductController::class, 'saveCheckOut'])->name('saveCheckOut');
//Search user
// Search
Route::get('search', [ProductController::class, 'getSearch'])->name('search');
