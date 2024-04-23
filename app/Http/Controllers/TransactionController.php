<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CartModels;
use App\Models\CategoryModels;
use App\Models\CheckoutProducts;
use Illuminate\Http\Request;
use App\Models\ProductModels;
use App\Models\CustomerModels;
use App\Models\TransactionModels;
use App\Models\VendorModels;
use App\Models\DetailProductsImages;
use App\Models\TransactionPayment;
use Midtrans\Transaction;

class TransactionController extends Controller
{
  public function productList(Request $request)
  {
    $minimumPrice = $request->input('minimumPrice');
    $maksimumPrice = $request->input('maksimumPrice');
    $filterCategory = $request->input('category');
    $product_paket = ProductModels::leftJoin('master_vendor', 'master_product.vendor_id', '=', 'master_vendor.vendor_id')->where('master_product.type', 'paket')->where('master_product.status', 'aktif');
    $product_eceran = ProductModels::leftJoin('master_vendor', 'master_product.vendor_id', '=', 'master_vendor.vendor_id')->where('master_product.type', 'eceran')->where('master_product.status', 'aktif');
    if ($minimumPrice && $maksimumPrice) {
      $product_paket->whereBetween('master_product.price', [str_replace('.', '', $minimumPrice), str_replace('.', '', $maksimumPrice)]);
      $product_eceran->whereBetween('master_product.price', [str_replace('.', '', $minimumPrice), str_replace('.', '', $maksimumPrice)]);
    }
    if ($filterCategory) {
      $product_paket->whereIn('master_product.category', $filterCategory);
      $product_eceran->whereIn('master_product.category', $filterCategory);
    }
    $filteredProductPaket = $product_paket->get();
    $filteredProductEceran = $product_eceran->get();

    $category = CategoryModels::all();
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    return view('products.productList', [
      'title' => 'Produk',
      'modul' => 'List Produk',
      'route' => 'List Produk',
      'user' => $user,
      'paket' => $filteredProductPaket,
      'eceran' => $filteredProductEceran,
      'category' => $category,
      'minimumPrice' => $minimumPrice,
      'maksimumPrice' => $maksimumPrice,
      'filterCategory' => $filterCategory,
    ]);
  }
  public function productDetail($codeProduct)
  {
    $product = ProductModels::where('code_product', $codeProduct)->first();
    $gallery = DetailProductsImages::where('code_product', $codeProduct)->take(4)->orderBy('created_at')->get();
    $review = CheckoutProducts::leftJoin('transaction', 'checkout_products.no_trans', '=', 'transaction.no_trans')->leftJoin('users', 'transaction.customer_id', '=', 'users.user_id')->where('checkout_products.code_product', '=', $codeProduct)->where('transaction.stars', '>', 0)->get();
    $totalProduct = CheckoutProducts::where('code_product', $codeProduct)->count();
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    return view('products.productDetail', [
      'title' => 'Produk',
      'modul' => 'List Produk',
      'route' => 'List Produk',
      'user' => $user,
      'product' => $product,
      'gallery' => $gallery,
      'review' => $review,
      'totalProduct' => $totalProduct,
    ]);
  }
  public function cart()
  {
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    return view('transaction.cart', [
      'title' => 'Keranjang',
      'modul' => 'List Produk',
      'route' => 'cart',
      'user' => $user,
    ]);
  }
  public function cartCheckout()
  {
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    return view('transaction.checkout', [
      'title' => 'Checkout',
      'modul' => 'Cart',
      'route' => 'cart',
      'user' => $user,
    ]);
  }

  public function updateInfo(Request $request)
  {
    if ($request->update == 'address') {
      $validatedData = $request->validate([
        'event_address' => 'required',
      ]);

      $updateData =  TransactionModels::where('no_trans', $request->no_trans)->update($validatedData);
      $messageText = 'Data alamat telah berhasil diupdate';
    } elseif ($request->update == 'eventDate') {
      $validatedData = $request->validate([
        'event_date' => 'required',
      ]);

      $updateData = TransactionModels::where('no_trans', $request->no_trans)->update($validatedData);
      $messageText = 'Tanggal acara telah berhasil diupdate';
    }
    if ($updateData) {
      return back()->with('success', $messageText);
    }
  }

  public function noteProduct(Request $request)
  {
    $validatedData = $request->validate([
      'remark' => 'required',
    ]);

    $updateData = CartModels::where('kode_produk', $request->codeProduct)->where('customer_id', auth()->user()->user_id)->update($validatedData);
    if ($updateData) {
      return back()->with('success', 'Berhasil menambahkan catatan produk');
    }
  }

  public function responseMidtrans(Request $request)
  {
    $transactionStatus = $request->input('transaction_status');
    $order_id = $request->input('order_id');

    $transaction = TransactionPayment::where('order_id', $order_id)->first();

    if ($transaction) {
      if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
        // Update data pembayaran 
        $transaction->update([
          'status' => 'Lunas',
          'trans_id' => $request->input('transaction_id'),
          'payment_date' => $request->input('transaction_time'),
        ]);

        // Update status transaksi
        TransactionModels::where('no_trans', $transaction->no_trans)
          ->update([
            'status' => 'Pesanan Diproses',
            'updated_at' => now(),
          ]);
      } else if ($transactionStatus == 'expire') {
        // Update status pembayaran
        TransactionPayment::where('no_trans', $transaction->no_trans)->update([
          'status' => 'Expired',
        ]);

        // Update status transaksi
        TransactionModels::where('no_trans', $transaction->no_trans)
          ->update([
            'status' => 'Pesanan Expire',
            'updated_at' => now(),
          ]);
      } else {
        // Update status pembayaran
        TransactionPayment::where('no_trans', $transaction->no_trans)->update([
          'status' => 'Dibatalkan',
        ]);

        // Update status transaksi
        TransactionModels::where('no_trans', $transaction->no_trans)
          ->update([
            'status' => 'Pesanan Dibatalkan',
            'updated_at' => now(),
          ]);
      }

      // Memberikan respons kepada klien
      return response($order_id, 200); // Ubah pesan respons sesuai kebutuhan Anda
    } else {
      // Jika transaksi tidak ditemukan
      return response('Transaksi tidak ditemukan', 404);
    }
  }
  public function transactionSuccess()
  {
    return view('transaction.transactionSuccess');
  }
  public function transactionFailed()
  {
    return view('transaction.transactionFailed');
  }
}
