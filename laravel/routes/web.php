<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductsController::class ,'show'])
->name('dashboard');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// products filter 
Route::get('/products/sort/{type}' , [ProductsController::class ,'show'])->name('products.sort');
Route::post('/products/search/' , [ProductsController::class ,'search'])->name('products.search');

// products resource
Route::middleware(['auth' , 'seller'])->group(function () {
    Route::resource('products', ProductsController::class)->name('create' , 'products.create');
});



// products cart
Route::post('carts/create/{id}' , [CartController::class , 'store'])->middleware('auth')->name('carts.create');
Route::get('carts/show' , [CartController::class , 'index'])->middleware('auth')->name('carts.index');
Route::get('carts/destroy/{id}' , [CartController::class , 'destroy'])->middleware('auth')->name('carts.destroy');

// payment transactions
Route::get('carts/checkout/payment/{id}' , [PaymentController::class , 'createpayment'])->middleware('auth')->name('createpayment');
Route::get('carts/checkout/payment/pay/{price}' , [PaymentController::class , 'payorder'])->name('payorder');
Route::get('carts/payment/callback/' ,[PaymentController::class , 'callback']);
Route::get('carts/payment/error/' ,[PaymentController::class , 'error']);
Route::get('carts/payment/show/' ,[PaymentController::class , 'show'])->middleware('auth')->name('payments.show');
Route::get('carts/payment/my_products_orderd/show' ,[PaymentController::class , 'seller_show'])->middleware('auth')->name('payments.seller_show');
Route::get('carts/payment/shipping/{id}' ,[PaymentController::class , 'shipping'])->middleware('auth')->name('payments.shipping');
Route::get('carts/payment/delivered/{id}' ,[PaymentController::class , 'delivered'])->middleware('auth')->name('payments.delivered');




// Change To Seller
Route::get('profile/Change To Seller' , [ProductsController::class , 'changetoseller'])->middleware(['auth'])
->name('changetoseller');

//About Us
Route::get('/About-Us' , function(){
    return view('aboutus');
})->name('aboutus');

//Contact Us
Route::get('/Contact-Us' , function(){
    return view('contactus');
})->name('contactus');

Route::post('/recive-mail' , [ProfileController::class , "recive_mail"])->name('recive.mail');

require __DIR__.'/auth.php';

