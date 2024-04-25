<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailProducts;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\TransactionAdmin;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Models\CategoryModels;
// models
use App\Models\CustomerModels;
use App\Models\TransactionModels;
use App\Models\VendorModels;
use App\Models\TransactionApproval;

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

Route::get('/apps', function () {
  $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
  if (!$user) {
    $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
  }
  if (auth()->user()->role == 'administrator') {
    $todayOrder = TransactionModels::whereDate('created_at', today())->count();
  } elseif (auth()->user()->role == 'vendor') {
    $todayOrder = TransactionApproval::whereDate('created_at', today())->where('vendor_id', '=', auth()->user()->user_id)->count();
  }else{
    $todayOrder='';
  }
  if (auth()->user()->role == 'administrator') {
    $totalOrder = TransactionModels::count();
  } elseif (auth()->user()->role == 'vendor') {
    $totalOrder = TransactionApproval::where('vendor_id', '=', auth()->user()->user_id)->count();
  }else{
    $totalOrder='';
  }
  $totalProfit = TransactionModels::where('status', 'Pesanan Selesai')
    ->sum('total_price');
  $category = CategoryModels::all();
  return view('dashboard', [
    'title' => 'Dashboard',
    'modul' => 'Dashboard',
    'route' => 'Dashboard',
    'user' => $user,
    'todayOrder' => $todayOrder,
    'totalOrder' => $totalOrder,
    'totalProfit' => $totalProfit,
    'category' => $category,
  ]);
})->name('dashboard')->middleware('auth');;

Route::controller(AuthController::class)->group(function () {
  Route::get('/', 'login')->name('login')->middleware('guest');;
  Route::get('/signup', 'signup')->name('signup')->middleware('guest');;
  Route::post('/signup-customer', 'signupCustomer')->name('signupCustomer');
  Route::post('/signup-vendor', 'signupVendor')->name('signupVendor');
  Route::post('/', 'authLogin')->name('authLogin');
  Route::post('/logout', 'authLogout')->name('authLogout');
});
Route::resource('/apps/role', roleController::class)->middleware(['auth', 'administrator']);
Route::resource('/apps/user', userController::class)->middleware(['auth', 'administrator']);
Route::resource('/apps/product', ProductController::class)->middleware(['auth', 'operator']);
Route::resource('/apps/profile', ProfileController::class)->middleware('auth');
Route::resource('/apps/category', CategoryController::class)->middleware(['auth', 'administrator']);
Route::resource('/apps/gallery-list', DetailProducts::class)->middleware(['auth', 'operator']);

Route::controller(TransactionController::class)->group(function () {
  Route::get('/apps/product-list', 'productList')->name('productList')->middleware(['auth', 'customer']);
  Route::get('/apps/product-list/{codeProduct}', 'productDetail')->name('productDetail')->middleware(['auth', 'customer']);
  Route::get('/apps/cart', 'cart')->name('cart')->middleware(['auth', 'customer']);
  Route::get('/apps/cart/checkout', 'cartCheckout')->name('cartCheckout')->middleware(['auth', 'customer']);
  Route::get('/apps/cart/checkout/success', 'transactionSuccess')->name('transactionSuccess')->middleware(['auth', 'customer']);
  Route::get('/apps/cart/checkout/failed', 'transactionFailed')->name('transactionFailed')->middleware(['auth', 'customer']);
  Route::post('/apps/cart/info', 'updateInfo')->name('updateInfo')->middleware('auth');
  Route::post('/apps/cart/noteproduct', 'noteProduct')->name('noteProduct')->middleware('auth');
  Route::post('/apps/cart/callbackmidtrans', 'responseMidtrans')->name('responseMidtrans')->middleware('auth');
});

Route::controller(OrderController::class)->group(function () {
  Route::get('/apps/order-list', 'orderList')->name('orderList')->middleware(['auth', 'customer']);
  Route::get('/apps/order-list/{no_trans}', 'orderDetail')->name('orderDetail')->middleware(['auth', 'customer']);
  Route::get('/apps/order-list/{no_trans}/{orderId}', 'orderCreatePayment')->name('orderCreatePayment')->middleware(['auth', 'customer']);
  Route::post('/apps/order-list/feedback', 'orderFeedback')->name('orderFeedback')->middleware('auth');
});

Route::controller(TransactionAdmin::class)->group(function () {
  Route::get('/apps/transaction-list', 'transactionList')->name('transactionList')->middleware('auth')->middleware(['auth', 'administrator']);
  Route::get('/apps/transaction-list/{no_trans}/detail', 'transactionDetail')->name('transactionDetail')->middleware(['auth', 'operator']);
  Route::get('/apps/transaction-list/approval', 'transactionApproval')->name('transactionApproval')->middleware(['auth', 'vendor']);
  Route::post('/apps/transaction-list/{no_trans}/approval', 'storeTransactionAprroval')->name('storeTransactionAprroval')->middleware('auth');
  Route::post('/apps/transaction-list/approval', 'approval')->name('approval')->middleware('auth');
  Route::post('/apps/transaction-list/update-status', 'statusUpdate')->name('statusUpdate')->middleware('auth');
});
