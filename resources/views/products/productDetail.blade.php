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
        <!--konten -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                    <div class="flex justify-between space-x-3">
                        {{-- informasi produk --}}
                        <div class="flex w-4/6">
                            {{-- foto produk --}}
                            <div class="w-1/2">
                                <img src="data:image/png;base64,{{ $product->picture }}" class="h-46 w-72 rounded-xl"
                                    alt="image product">
                            </div>
                            {{-- detail produk --}}
                            <div class="flex flex-col w-1/2">
                                <p class="font-semibold text-slate-950">{{ $product->product }}</p>
                                {{-- informasi vendor & total jumlah terjual --}}
                                <div class="flex mt-2 space-x-4">
                                    {{-- informasi vendor --}}
                                    <div class="flex items-center gap-2">
                                        {{-- SVG Store --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-950"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-store">
                                            <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7" />
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                            <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4" />
                                            <path d="M2 7h20" />
                                            <path
                                                d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7" />
                                        </svg>
                                        <p class="text-gray-500 text-xs font-medium">Suci Wedding Organizer</p>
                                    </div>
                                    {{-- informasi total jumlah terjual --}}
                                    <p class="text-sm text-slate-950">Terjual <span
                                            class="text-gray-600">{{ number_format($totalProduct) }}</span></p>
                                </div>
                                {{-- informasi harga produk --}}
                                <p class="text-2xl text-slate-950 font-bold mt-1">
                                    Rp{{ str_replace(',', '.', number_format($product->price)) }}</p>
                                {{-- tabs --}}
                                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                                        data-tabs-toggle="#default-tab-content" role="tablist">
                                        <li class="me-2" role="presentation">
                                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                                                data-tabs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">Detail Produk</button>
                                        </li>
                                        <li class="me-2" role="presentation">
                                            <button
                                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                                id="rating-tab" data-tabs-target="#rating" type="button" role="tab"
                                                aria-controls="rating" aria-selected="false">Rating</button>
                                        </li>
                                    </ul>
                                </div>
                                <div id="default-tab-content" class="mt-2 max-h-52 overflow-y-auto">
                                    {{-- galeri produk --}}
                                    <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        @if (count($gallery) > 0)
                                            <div class="flex space-x-2">
                                                @foreach ($gallery as $item)
                                                    <a data-fancybox="gallery"
                                                        data-src="data:image/png;base64,{{ $item->images }}"
                                                        data-caption="images product {{ $product->product }}">
                                                        <img src="data:image/png;base64,{{ $item->images }}"
                                                            class="h-32 w-20 rounded-lg" alt="" />
                                                    </a>
                                                @endforeach
                                            </div>
                                            <p class="text-xs text-red-500 mt-2">*Note: cek gambar diatas untuk
                                                penjelasan produk</p>
                                        @else
                                            <p class="text-center text-slate-800 font-medium">Galeri masih kosong...
                                            </p>
                                        @endif
                                    </div>
                                    {{-- review produk --}}
                                    <div class="p-4 rounded-lg" id="rating" role="tabpanel"
                                        aria-labelledby="rating-tab">
                                        @if (count($review) > 0)
                                            <ul class="w-full text-sm font-medium text-gray-900 bg-white">
                                                @foreach ($review as $item)
                                                    <li class="w-full px-4 py-2 border-b border-gray-200">
                                                        <div class="flex items-center gap-1">
                                                            @for ($i = 0; $i < $item->stars; $i++)
                                                                <i
                                                                    class="cursor-pointer text-yellow-400 fas fa-star fa-sm"></i>
                                                            @endfor
                                                            <p class="ms-2 text-gray-500 font-semibold text-sm">
                                                                {{ Carbon\Carbon::parse($item->review_date)->locale('id')->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center mt-3">
                                                            <img src="{{ asset('assets/img/default_v3-usrnophoto.png.webp') }}"
                                                                class="rounded-full h-6 w-6" alt="">
                                                            <p class="ms-2 text-slate-900 font-semibold text-sm">
                                                                {{ $item->fullname }}</p>
                                                        </div>
                                                        <p class="text-slate-900 text-sm mt-2">
                                                            {{ $item->feedback_detail }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-center text-slate-800 font-medium">Belum ada review pelanggan
                                            </p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- call to action --}}
                        <div class="w-1/3">
                            <div class="border border-gray-400 rounded-lg mx-5 px-4 pb-5">
                                <p class="text-slate-950 font-bold pt-3">Pilih Metode Pembelian</p>
                                @livewire('add-to-cart', ['customer_id' => auth()->user()->user_id, 'code_product' => $product->code_product, 'type' => 'productDetail'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    {{-- fancybox --}}
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            Thumbs: false,
            Toolbar: false,

            Image: {
                zoom: false,
                click: false,
                wheel: "slide",
            },
        });
    </script>
@endsection
