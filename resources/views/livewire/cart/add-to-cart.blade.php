<div>
    @if ($type == 'default')
        <div class="flex items-center gap-3 mt-3">
            <button wire:click.prevent="checkout('{{ $code_product }}')"
                class="flex gap-2 justify-center w-full items-center text-white bg-blue-950 hover:bg-blue-900 rounded-lg text-sm px-2 py-2 text-center"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-bag">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                    <path d="M3 6h18" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                <p class="font-semibold">Beli Langsung</p>
            </button>
            <button wire:click.prevent="addtoCart('{{ $code_product }}')"
                class="flex gap-2 items-center bg-inherit border border-blue-950 text-blue-950 font-medium rounded-lg text-xs px-2 py-2 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 lucide lucide-shopping-cart" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
            </button>
        </div>
    @elseif($type == 'productDetail')
        <div class="flex flex-col space-y-2 mt-4">
            <button wire:click.prevent="addtoCart('{{ $code_product }}')"
                class="bg-blue-950 text-white font-semibold py-2 rounded-lg flex items-center justify-center gap-1"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>Keranjang</button>
            <button wire:click.prevent="checkout('{{ $code_product }}')"
                class="bg-white border border-blue-950 text-blue-950 font-semibold text-center py-2 rounded-lg">Beli</button>
        </div>
    @endif
</div>
