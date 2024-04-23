<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CheckoutProducts;
use App\Models\TransactionModels;
use App\Models\TransactionPayment;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use Carbon\Carbon;
use Carbon\CarbonInterface;

// Set locale ke Indonesia
Carbon::setLocale('id');


class CheckoutIndex extends Component
{
  public $customer_id;
  public $products_list;
  public $totalPrice;
  public $type;
  public $products;
  public $data;
  public function render()
  {
    $ProductList = session('ProductsList');
    $snapToken = session('snapToken');
    $no_trans = session('no_trans');
    $this->products_list = $ProductList;
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    $transaction = TransactionModels::where('no_trans', $no_trans)->first();
    // Parse tanggal menggunakan Carbon
    $tanggal_parsed = Carbon::parse($transaction->event_date);

    // Ubah format menjadi "d F Y" (contoh: "28 April 2024")
    $tanggalAcara = $tanggal_parsed->isoFormat('D MMMM YYYY');
    return view('livewire.checkout.checkout-index', [
      'user' => $user,
      'list_product' => $this->products_list,
      'snapToken' => $snapToken,
      'no_trans' => $no_trans,
      'transaction' => $transaction,
      'tanggalAcara' => $tanggalAcara,
    ]);
  }
}
