<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\CartModels;

class AddToCart extends Component
{
  public $customer_id;
  public $code_product;
  public $type;

  public function render()
  {
    return view('livewire.cart.add-to-cart', [
      'customer_id' => $this->customer_id,
      'code_product' => $this->code_product,
      'type' => $this->type,
    ]);
  }
  public function checkout($code_product)
  {
    $productCart = CartModels::where('customer_id', auth()->user()->user_id)
      ->where('kode_produk', $code_product)
      ->first();

    if ($productCart) {
      $productCart->update([
        'qty' => $productCart->qty + 1,
        'created_by' => auth()->user()->fullname,
        'created_date' => Carbon::now()
      ]);
    } else {
      CartModels::create([
        'customer_id' => auth()->user()->user_id,
        'kode_produk' => $code_product,
        'qty' => '1',
        'created_by' => auth()->user()->fullname,
        'created_date' => Carbon::now()
      ]);
    }

    $this->dispatch('success', ['message' => 'Produk berhasil ditambahkan kedalam keranjang']);
    $this->dispatch('addToCart');
    $this->redirectRoute('cart');
  }
  public function addtoCart($code_product)
  {
    $productCart = CartModels::where('customer_id', auth()->user()->user_id)
      ->where('kode_produk', $code_product)
      ->first();

    if ($productCart) {
      $productCart->update([
        'qty' => $productCart->qty + 1,
        'created_by' => auth()->user()->fullname,
        'created_date' => Carbon::now()
      ]);
    } else {
      CartModels::create([
        'customer_id' => auth()->user()->user_id,
        'kode_produk' => $code_product,
        'qty' => '1',
        'created_by' => auth()->user()->fullname,
        'created_date' => Carbon::now()
      ]);
    }

    $this->dispatch('success', ['message' => 'Produk berhasil ditambahkan kedalam keranjang']);
    $this->dispatch('addToCart');
  }
}
