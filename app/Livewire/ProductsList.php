<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Livewire;

class ProductsList extends Component
{
    public $receivedData;

    public function updateProductsList($data) // Function name matches event name
    {
        Livewire::dump($data);
        $this->receivedData = $data;
        // Process the received data here (e.g., validation, update state)
    }

    public function render()
    {
        return view('livewire.checkout.products-list');
    }
}
