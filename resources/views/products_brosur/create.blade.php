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
                    <li class="text-sm leading-normal before:float-left before:px-2  before:content-['/']">
                        <a class="text-white opacity-50" href="javascript:;">{{ $modul }}</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page">{{ $title }}</li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">{{ $title }}</h6>
            </nav>
            <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex justify-end pl-0 mb-0 list-none md-max:w-full gap-5 items-center">
                    <div class="flex gap-2 border-r border-white">
                        @if (auth()->user()->role == 'customer')
                            {{-- button keranjang --}}
                            @livewire('cart-counter')
                            <button type="button" class="block p-0 me-1 text-sm text-white transition-all ease-nav-brand">
                            </button>
                        @endif
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
    @if (session()->has('error'))
        <script>
            Swal.fire({
                position: "center",
                icon: "error",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                    {{-- call to action --}}
                    <div class="flex justify-end w-full items-center ">
                        <a href="{{ route($route . '.index') }}"
                            class="bg-blue-950 py-2 px-3 text-sm rounded-lg text-white font-medium">Kembali</a>
                    </div>
                    <form action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="grid grid-cols-4 gap-5 mt-5">
                            {{-- brosur produk --}}
                            <div class="mb-5 col-span-2">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Brosur
                                    Produk</label>
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="dropzone-file"
                                            class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                                    id="dropzone-label">
                                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500"><span
                                                            class="font-semibold">Click
                                                            to
                                                            upload
                                                            <p class="text-xs text-gray-500">PNG, JPG or PNG
                                                                (MAX. 2MB)</p>
                                                </div>
                                                <img id="dropzone-img" src="" alt="">
                                            </div>
                                            <input id="dropzone-file" type="file" class="hidden" name="images" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                {{-- select list produk --}}
                                <div class="mb-5">
                                    <label for="product"
                                        class="block mb-2 text-sm font-medium text-gray-900">Produk</label>
                                    <select id="product" name="code_product"
                                        class="@error('code_product') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5">
                                        <option selected disabled>Pilih Produk</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->code_product }}">{{ $item->product }}</option>
                                        @endforeach
                                    </select>
                                    @error('code_product')
                                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- select list vendor --}}
                                <div class="mb-5">
                                    <label for="vendor"
                                        class="block mb-2 text-sm font-medium text-gray-900">Vendor</label>
                                    <select id="vendor" name="vendor_id"
                                        class="@error('vendor_id') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5">
                                        <option selected disabled>Pilih Vendor</option>
                                        @foreach ($vendor as $item)
                                            <option value="{{ $item->vendor_id }}">{{ $item->fullname }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- select list status --}}
                                <div class="mb-5">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                    <select id="status" name="status"
                                        class="@error('status') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="draft">Draft</option>
                                        <option value="aktif">Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="flex justify-end">
                            <button
                                class="bg-green-600 px-4 py-2 text-white rounded-lg text-sm font-medium">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script>
        $(document).ready(() => {
            $('#product').select2();
            $('#vendor').select2();
        });
        let img = document.getElementById('dropzone-img')
        let dropZoneInput = document.getElementById('dropzone-file')
        const dropZoneLabel = document.getElementById('dropzone-label')
        const dropZoneImg = document.getElementById('dropzone-img')
        dropZoneInput.onchange = (e) => {
            if (dropZoneInput.files[0])
                img.src = URL.createObjectURL(dropZoneInput.files[0])
            dropZoneLabel.classList.add("hidden")
            dropZoneImg.classList.add("h-32")
        }

        function numberWithDotes(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function nominalFormat(e) {
            let nominal = e.replace(/\D/g, '');
            nominal = 'Rp.' + numberWithDotes(nominal);
            $('#price').val(nominal);
        }
    </script>
@endsection
