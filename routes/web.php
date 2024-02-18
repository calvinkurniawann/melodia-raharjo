<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Models\Category;

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
    $barangs = Barang::latest()->take(5)->get();
    $guitarProducts = Barang::where('category_id', '6')->get();
    $keyboardProducts = Barang::where('category_id', '3')->get();
    $drumProducts = Barang::where('category_id', '5')->get();
    return view('home', compact(
        'barangs', 'guitarProducts', 'keyboardProducts', 'drumProducts'
    ));
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-account',[UserController::class,'index'])->name('user.index');
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::prefix('dashboard')->group(function () {
    Route::resource('barang', BarangController::class, ['as' => 'dashboard']);
    Route::resource('category', CategoryController::class, ['as' => 'dashboard']);
    Route::resource('user', UserManagementController::class, ['as' => 'dashboard']);
    Route::resource('order', OrderController::class, ['as' => 'dashboard']);
})->middleware(['auth', 'verified','auth.admin']);

Route::get('/cart', [CartController::class, 'CartView'])->name('cart');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/barang/search',[BarangController::class,'search']);

Route::post('/order/pay-and-create', [OrderController::class, 'payAndCreateOrder'])->name('order.payAndCreateOrder');
Route::post('/order/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
Route::put('/order/terima', [OrderController::class, 'terima'])->name('order.terima');
Route::put('/order/selesai', [OrderController::class, 'selesai'])->name('order.selesai');
Route::get('/order/pesanan-pending', [OrderController::class, 'PesananPendingView'])->name('order.PesananPendingView');
Route::get('/order/pesanan-paid', [OrderController::class, 'PesananPaidView'])->name('order.PesananPaidView');

Route::resource('orders', OrderController::class)->only(['index', 'show']);

Route::get('/category/page', [CategoryController::class, 'page'])->name('categories.page');

require __DIR__.'/auth.php';
