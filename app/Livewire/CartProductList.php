<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartModels;
use App\Models\CheckoutProducts;
use App\Models\TransactionModels;
use App\Models\TransactionPayment;
use App\Models\CustomerModels;

class CartProductList extends Component
{

  public $remarkProduct = '';
  public $CodeProducts = '';
  public function processingCheckout($data)
  {
    $totalPrice = 0;
    $currentYear = date('Y');
    // ambil data jumlah transaksi di database
    $totalTrans = TransactionModels::where('year', $currentYear)->count() + 1;
    $totalOrder = TransactionPayment::where('year', $currentYear)->count();
    $order_id = rand();
    // membuat no transaksi
    $no_trans = 'B-' . $currentYear . '-' .  sprintf("%04d", $totalTrans);
    // membuat order_id
    // get data user
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();

    // simpan data produk yang dibeli
    foreach ($data as $product) {
      $totalPrice += $product['productPrice'] * $product['productQty'];
      CheckoutProducts::create([
        'no_trans' =>  $no_trans,
        'code_product' => $product['codeProduct'],
        'qty' => $product['productQty'],
        'price' => $product['productPrice'],
        'remark' => $product['productNote'],
      ]);
    }
    // simpan data transaksi
    $transaction = TransactionModels::create([
      'year' => $currentYear,
      'no_trans' => $no_trans,
      'customer_id' => auth()->user()->user_id,
      'total_price' => $totalPrice,
      'status' => 'Menunggu Pembayaran',
    ]);
    if ($transaction) {
      // simpan data history pembayaran customer
      // order id
      // $currentYear . '-' .  sprintf("%06d", $totalOrder + $i)
      for ($i = 1; $i < 3; $i++) {
        TransactionPayment::create([
          'payment_name' =>  'pembayaran ' . $i,
          'order_id' =>  $order_id + $i,
          'no_trans' => $no_trans,
          'year' => $currentYear,
          'customer_id' => auth()->user()->user_id,
          'price' => $totalPrice / 2,
          'status' => 'Belum Bayar'
        ]);

        // delete data produk di dalam tabel cart
        foreach ($data as $product) {
          CartModels::where('kode_produk', $product['codeProduct'])->where('customer_id', auth()->user()->user_id)->delete();
        }
      }
      // Set your Merchant Server Key
      \Midtrans\Config::$serverKey = config('midtrans.server_key');
      // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
      \Midtrans\Config::$isProduction = false;
      // Set sanitization on (default)
      \Midtrans\Config::$isSanitized = true;
      // Set 3DS transaction for credit card to true
      \Midtrans\Config::$is3ds = true;
      // order id
      $params = [
        'transaction_details' => [
          'order_id' => $order_id + 1,
          'gross_amount' => $totalPrice / 2,
        ],
        'item_details' => [],
        'customer_details' => [
          'first_name' => $user->fullname,
          'phone' => '0' . $user->phone,
        ],
      ];
      // data list produk yang dibeli untuk dikirim ke midtransF 
      foreach ($data as $product) {
        $params['item_details'][] = [
          'id' => $product['codeProduct'],
          'price' => $product['productPrice'] / 2,
          'quantity' => $product['productQty'],
          'name' => $product['productName'],
        ];
      }

      $snapToken = \Midtrans\Snap::getSnapToken($params);

      session()->forget('ProductsList');
      session(['ProductsList' => $data]);
      session()->forget('snapToken');
      session(['snapToken' => $snapToken]);
      session()->forget('no_trans');
      session(['no_trans' => $no_trans]);
      $this->redirectRoute('cartCheckout');
    }
  }

  public function updateQty($codeProduct, $type)
  {
    CartModels::where('kode_produk', $codeProduct)
      ->where('customer_id', auth()->user()->user_id)
      ->when($type == 'increment', function ($query) {
        $query->increment('qty');
      })
      ->when($type == 'decrement', function ($query) {
        $query->decrement('qty');
      })
      ->get();
  }

  public function deleteProduct($codeProduct)
  {
    CartModels::where('kode_produk', $codeProduct)
      ->where('customer_id', auth()->user()->user_id)
      ->delete();
    $this->dispatch('success', ['message' => '1 produk berhasil dihapus']);
  }
  public function render()
  {
    $cart = CartModels::join('master_product', 'cart_products.kode_produk', '=', 'master_product.code_product')
      ->where('cart_products.customer_id', auth()->user()->user_id)
      ->select('cart_products.*', 'master_product.product as product_name', 'master_product.price as product_price', 'master_product.picture as product_picture')
      ->orderBy('cart_products.created_at', 'DESC')
      ->get();
    return view('livewire.cart.cart-product-list', [
      'cart' => $cart,
    ]);
  }
}
