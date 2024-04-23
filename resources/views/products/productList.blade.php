@extends('layout.index')
@section('content')
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="false">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="text-white opacity-50" href="javascript:;">Dashboard</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page">{{ $title }}</li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">{{ $title }}</h6>
            </nav>
            <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex justify-end pl-0 mb-0 list-none md-max:w-full gap-5 items-center">
                    <div class="flex gap-2 border-r border-white">
                        {{-- button keranjang --}}
                        @livewire('cart-counter')
                        <button type="button" class="block p-0 text-sm text-white transition-all ease-nav-brand">
                        </button>
                        {{-- button notifikasi --}}
                        <button type="button" class="relative p-3 me-5 text-sm font-medium text-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-bell-ring">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                                <path d="M4 2C2.8 3.7 2 5.7 2 8" />
                                <path d="M22 8c0-2.3-.8-4.3-2-6" />
                            </svg>
                            <div
                                class="absolute inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 border border-white rounded-full -top-1 -end-1">
                                20</div>
                        </button>
                    </div>
                    <li class="flex items-center">
                        <button data-popover-target="popover-bottom" data-popover-placement="bottom" type="button"
                            class="block p-0 text-sm text-white transition-all ease-nav-brand">
                            <i class="fa fa-user sm:mr-1"></i> <span
                                class="hidden sm:inline">{{ auth()->user()->fullname }}</span></button>
                        <div data-popover id="popover-bottom" role="tooltip"
                            class="absolute z-50 invisible inline-block w-48 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                            {{-- content dropdown --}}
                            <div class="w-full text-gray-900 bg-white border-0 border-gray-200 rounded-lg">
                                <div
                                    class="px-4 py-3  flex flex-col space-y-2 text-sm text-gray-900 border-b border-gray-200">
                                    <div class="font-semibold">{{ auth()->user()->fullname }}</div>
                                    <p>{{ $user->email != '' ? $user->email : '-' }}</p>
                                </div>
                                <a href="{{ route('profile.index') }}"
                                    class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 me-2.5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-circle-user">
                                        <circle cx="12" cy="12" r="10" />
                                        <circle cx="12" cy="10" r="3" />
                                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                    </svg>
                                    Profil
                                </a>
                                <form action="{{ route('authLogout') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium rounded-b-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-0">
                                        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>

                                        Keluar
                                    </button>
                                </form>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </li>
                    <li class="flex items-center pl-4 xl:hidden">
                        <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                            sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                            </div>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <!-- end Navbar -->
    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                    {{-- dropdown --}}
                    <div id="accordion-collapse" data-accordion="collapse" class="mb-5">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-auto  py-2 px-3 font-medium  text-gray-600 border border-gray-300 rounded-lg focus:ring-0 gap-3"
                                data-accordion-target="#accordion-collapse-body-1"
                                aria-expanded="{{ !empty($minimumPrice) || !empty($maksimumPrice) || !empty($filterCategory) ? 'true' : 'false' }}"
                                aria-controls="accordion-collapse-body-1">
                                <span>Filter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-gray-200 rounded-lg mt-3">
                                <form action="{{ route('productList') }}" method="GET">
                                    <div class="flex">
                                        <p class="w-1/2 font-semibold text-slate-700 text-sm">Harga</p>
                                        <p class="w-1/2 font-semibold text-slate-700 text-sm">Kategori</p>
                                    </div>
                                    {{-- form filter --}}
                                    <div class="flex items-center space-x-3">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <span class="font-bold text-slate-500">Rp</span>
                                            </div>
                                            <input type="text" id="minimumPrice" name="minimumPrice"
                                                onkeyup="getNomimal(value, id)" value="{{ $minimumPrice }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full ps-10 p-2.5"
                                                placeholder="Harga Minimum">
                                        </div>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <span class="font-bold text-slate-500">Rp</span>
                                            </div>
                                            <input type="text" id="maksimumPrice" name="maksimumPrice"
                                                onkeyup="getNomimal(value, id)" value="{{ $maksimumPrice }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full ps-10 p-2.5"
                                                placeholder="Harga Maksimum">
                                        </div>
                                        <div class="grid grid-cols-4 gap-4 mt-3">
                                            @foreach ($category as $data)
                                                <div class="col-span-2 flex items-center ms-5 mb-4">
                                                    <input id="default-checkbox-{{ $data->id }}" type="checkbox"
                                                        name="category[]" value="{{ $data->category }}"
                                                        class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                                        {{ $filterCategory && in_array($data->category, $filterCategory) ? 'checked' : '' }}>
                                                    <label for="default-checkbox-{{ $data->id }}"
                                                        class="ms-2 text-sm font-medium text-gray-900">{{ $data->category }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="bg-blue-950 text-white font-semibold py-2 px-3 text-sm rounded-lg">Terapkan
                                            Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- tabs --}}
                    <div class="border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                            <li class="me-2">
                                <button onclick="toggle('paket')" id="btnPaket"
                                    class="inline-flex items-center justify-center p-4 border-b-2 text-blue-600 border-blue-600 rounded-t-lg active group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-package">
                                        <path d="m7.5 4.27 9 5.15" />
                                        <path
                                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                        <path d="m3.3 7 8.7 5 8.7-5" />
                                        <path d="M12 22V12" />
                                    </svg>Paket
                                </button>
                            </li>
                            <li class="me-2">
                                <button onclick="toggle('eceran')" id="btnEceran"
                                    class="inline-flex items-center justify-center p-4 border-transparent border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 group"
                                    aria-current="page">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-shopping-basket">
                                        <path d="m15 11-1 9" />
                                        <path d="m19 11-4-7" />
                                        <path d="M2 11h20" />
                                        <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4" />
                                        <path d="M4.5 15.5h15" />
                                        <path d="m5 11 4-7" />
                                        <path d="m9 11 1 9" />
                                    </svg>Eceran
                                </button>
                            </li>
                        </ul>
                    </div>
                    {{-- list produk paket --}}
                    <div id="paketTabs">
                        {{-- cek jika data ada maka munculkan data produk --}}
                        @if (count($paket) > 0)
                            <div class="grid grid-cols-4 gap-5 my-5">
                                @foreach ($paket as $item)
                                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="{{ route('productDetail', ['codeProduct' => $item->code_product]) }}">
                                            <img class="rounded-t-lg" src="data:image/png;base64,{{ $item->picture }}"
                                                alt="product image" />
                                        </a>
                                        <div class="px-2 pb-3 pt-5">
                                            <div class="flex flex-col space-y-1">
                                                <p class="text-sm font-semibold text-gray-900 line-clamp-2">
                                                    {{ $item->product }}</p>
                                                <span class="text-base font-bold text-gray-900">Rp
                                                    {{ str_replace(',', '.', number_format($item->price)) }}</span>
                                                {{-- informasi vendor --}}
                                                <div class="flex items-center gap-1">
                                                    {{-- SVG Store --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-950"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-store">
                                                        <path
                                                            d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7" />
                                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                                        <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                                                        <path d="M2 7h20" />
                                                        <path
                                                            d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7" />
                                                    </svg>
                                                    <p class="text-gray-500 text-xs font-medium ">{{ $item->fullname }}
                                                    </p>
                                                </div>
                                            </div>
                                            @livewire('add-to-cart', ['customer_id' => auth()->user()->user_id, 'code_product' => $item->code_product, 'type' => 'default'])
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="flex justify-center w-full my-5 font-semibold text-slate-800">Produk tidak ditemukan
                            </p>
                        @endif

                    </div>
                    {{-- list produk eceran --}}
                    <div id="eceranTabs" class="hidden">
                        {{-- cek jika data ada maka munculkan data produk --}}
                        @if (count($eceran) > 0)
                            <div class="grid grid-cols-4 gap-5 my-5">
                                @foreach ($eceran as $item)
                                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="{{ route('productDetail', ['codeProduct' => $item->code_product]) }}">
                                            <img class="rounded-t-lg" src="data:image/png;base64,{{ $item->picture }}"
                                                alt="product image" />
                                        </a>
                                        <div class="px-2 pb-3 pt-5">
                                            <div class="flex flex-col space-y-1">
                                                <p class="text-sm font-semibold text-gray-900 line-clamp-2">
                                                    {{ $item->product }}</p>
                                                <span class="text-base font-bold text-gray-900">Rp
                                                    {{ str_replace(',', '.', number_format($item->price)) }}</span>
                                                {{-- informasi vendor --}}
                                                <div class="flex items-center gap-1">
                                                    {{-- SVG Store --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-950"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-store">
                                                        <path
                                                            d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7" />
                                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                                        <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                                                        <path d="M2 7h20" />
                                                        <path
                                                            d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7" />
                                                    </svg>
                                                    <p class="text-gray-500 text-xs font-medium ">{{ $item->fullname }}
                                                    </p>
                                                </div>
                                            </div>
                                            @livewire('add-to-cart', ['customer_id' => auth()->user()->user_id, 'code_product' => $item->code_product, 'type' => 'default'])
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="flex justify-center w-full my-5 font-semibold text-slate-800">Produk tidak ditemukan
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script>
        // function format nominal
        function numberWithDotes(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function getNomimal(e, id) {
            let nominal = e.replace(/\D/g, '');
            $('#' + id).val(numberWithDotes(nominal));
        }
        // function toggle tabs
        function toggle(mode) {
            const paketTabs = document.getElementById('paketTabs');
            const eceranTabs = document.getElementById('eceranTabs');
            const btnEceran = document.getElementById('btnEceran');
            const btnPaket = document.getElementById('btnPaket');

            if (mode == 'eceran') {
                eceranTabs.classList.remove('hidden')
                paketTabs.classList.add('hidden')
                btnEceran.classList.add('text-blue-600', 'border-blue-600', 'active')
                btnEceran.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300')
                btnPaket.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300')
                btnPaket.classList.remove('text-blue-600', 'border-blue-600', 'active')
            } else {
                eceranTabs.classList.add('hidden')
                paketTabs.classList.remove('hidden')
                btnEceran.classList.remove('text-blue-600', 'border-blue-600', 'active')
                btnEceran.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300')
                btnPaket.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300')
                btnPaket.classList.add('text-blue-600', 'border-blue-600', 'active')
            }
        }
    </script>
@endsection
