<?php

namespace App\Http\Controllers;

use App\Models\CheckoutProducts;
use Illuminate\Http\Request;
use App\Models\TransactionModels;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use App\Models\TransactionPayment;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function orderList(Request $request)
  {
    $search = $request->input('search');
    $filterTgl = $request->input('filterTgl');
    $filterStatus = $request->input('filterStatus');
    // memecah filter tanggal range 
    $date = explode(" - ", $filterTgl);

    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }

    $transactions = TransactionModels::where('customer_id', auth()->user()->user_id)
      ->where('no_trans', 'like', '%' . $search . '%');

    if ($filterStatus) {
      $transactions->where('status', $filterStatus);
    }
    if ($filterTgl) {
      $transactions = $transactions->whereBetween('created_at', [$date[0], $date[1]]);
    }
    $transactions = $transactions->orderBy('created_at', 'desc')->paginate(10);


    // Membuat array untuk menampung semua nomor transaksi yang ditemukan
    $transactionIds = $transactions->pluck('no_trans');

    // Menggunakan nomor transaksi yang ditemukan untuk mendapatkan data produk
    $products = CheckoutProducts::whereIn('no_trans', $transactionIds)
      ->join('master_product', 'checkout_products.code_product', '=', 'master_product.code_product')
      ->get()
      ->groupBy('no_trans');
    return view('order.order-list', [
      'title' => 'Pesanan Saya',
      'modul' => 'order',
      'route' => 'product',
      'user' => $user,
      'transactions' => $transactions,
      'products' => $products,
      'search' => $search,
      'filterStatus' => $filterStatus,
      'filterTgl' => $filterTgl,
    ]);
  }
  public function orderDetail($no_trans)
  {
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    // ambil data transaksi
    $transactions = TransactionModels::Where('no_trans', $no_trans)->first();
    // ambil data tagihan costumer per nomor transaksi
    $bills = TransactionPayment::Where('no_trans', $no_trans)->get();
    // ambil data produk yang dibeli
    $products = CheckoutProducts::where('no_trans', $no_trans)
      ->join('master_product', 'checkout_products.code_product', '=', 'master_product.code_product')
      ->get();
    // Mengumpulkan id vendr dari setiap produk
    $vendorIds = $products->pluck('vendor_id')->unique()->toArray();
    // Mengambil vendor berdasarkan vendor_id yang terkumpul
    $vendor = VendorModels::whereIn('master_vendor.vendor_id', $vendorIds)
      ->leftJoin('transaction_approval', 'master_vendor.vendor_id', '=', 'transaction_approval.vendor_id')
      ->get();

    // mengkalkulasi selisih hari dengan tanggal acara
    if ($transactions->event_date) {
      $currentDate = Carbon::now();
      $dataDate = Carbon::createFromFormat('Y-m-d', $transactions->event_date);
    }
    $diffInDays = $transactions->event_date ? $currentDate->diffInDays($dataDate, false) : '';
    return view('order.orderDetail', [
      'title' => 'Detail Pesanan',
      'modul' => 'order',
      'route' => 'product',
      'user' => $user,
      'transactions' => $transactions,
      'bills' => $bills,
      'products' => $products,
      'diffInDays' => $diffInDays,
      'vendor' => $vendor,
    ]);
  }
  public function orderFeedback(Request $request)
  {
    $validateData = $request->validate([
      'stars' => 'required',
      'feedback' => 'required',
    ]);
    $validateData['feedback_detail'] = $request->feedback_detail;
    $validateData['review_date'] = date('Y-m-d H:i:s');
    $result = TransactionModels::where('no_trans', $request->no_trans)->update($validateData);
    if ($result) {
      return back()->with('success', 'Terima kasih!, ulasan anda telah dikirim');
    }
    return back()->with('error', 'Ulasan anda gagal terkirim');
  }
  public function orderCreatePayment($no_trans, $orderId)
  {
    $order_id = rand();
    // proses mengubah nomor order id dengan yang baru
    TransactionPayment::where('order_id', $orderId)->update(['order_id' => $order_id]);
    // ambil data customer
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    // ambil data transaksi
    $transactions = TransactionModels::where('no_trans', $no_trans)->first();
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    $params = [
      'transaction_details' => [
        'order_id' => $order_id,
        'gross_amount' => $transactions->total_price / 2,
      ],
      'customer_details' => [
        'first_name' => $user->fullname,
        'phone' => '0' . $user->phone,
      ],
    ];
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return view('order.splash', [
      'snapToken' => $snapToken,
    ]);
  }
}
