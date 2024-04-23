<?php

namespace App\Livewire;

use App\Models\CartModels;
use Livewire\Component;

class CartCounter extends Component
{
    #[\Livewire\Attributes\On('addToCart')]

    public function render()
    {
        return view('livewire.cart.cart-counter', [
            'totalItems' => CartModels::where('customer_id', auth()->user()->user_id)
            ->sum('qty')
        ]);
    }
}
