@extends('layout.index')
@section('content')
    @php
        function formatDate($tanggal)
        {
            // Array untuk mengubah nama bulan dalam bahasa Indonesia
            $bulan = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ];

            // Memecah tanggal menjadi bagian-bagian
            $bagianTanggal = explode(' ', $tanggal);
            $bagianTanggal = explode('-', $bagianTanggal[0]);
            $hari = $bagianTanggal[2];
            $bulanIndex = (int) $bagianTanggal[1] - 1; // Mengurangi 1 karena index array dimulai dari 0
            $tahun = $bagianTanggal[0];

            // Menggabungkan kembali dengan format yang diinginkan
            $tanggalIndonesia = $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;

            return $tanggalIndonesia;
        }
    @endphp
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
                        @if (auth()->user()->role == 'customer')
                            {{-- button keranjang --}}
                            @livewire('cart-counter')
                            <button type="button" class="block p-0 me-1 text-sm text-white transition-all ease-nav-brand">
                            </button>
                        @endif
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
    @if (session()->has('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
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
                    {{-- filter view --}}
                    <form class="flex gap-3 w-full items-center mb-5" action="{{ route('orderList') }}" method="GET">
                        {{-- search form --}}
                        <div class="relative w-1/4">
                            <input type="text" name="search" value="{{ $search }}" id="default-search"
                                class="block w-full py-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-blue-950"
                                placeholder="Cari no transaksi..." />
                            <button type="submit"
                                class="absolute end-2.5 bottom-2 font-medium rounded-lg text-sm px-4 py-2"><svg
                                    class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg></button>
                        </div>
                        {{-- filter status --}}
                        <div class="relative w-1/4">
                            <select name="filterStatus" onchange="this.form.submit()"
                                class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-blue-950">
                                <option selected value="">Pilih status</option>
                                <option value="Menunggu Pembayaran"
                                    {{ $filterStatus == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran
                                </option>
                                <option value="Pesanan Diproses"
                                    {{ $filterStatus == 'Pesanan Diproses' ? 'selected' : '' }}>Pesanan Diproses</option>
                                <option value="Pesanan Dibatalkan"
                                    {{ $filterStatus == 'Pesanan Dibatalkan' ? 'selected' : '' }}>Pesanan Dibatalkan
                                </option>
                                <option value="Pesanan Selesai"
                                    {{ $filterStatus == 'Pesanan Selesai' ? 'selected' : '' }}>
                                    Pesanan Selesai</option>
                                <option value="Pesanan Berlangsung"
                                    {{ $filterStatus == 'Pesanan Berlangsung' ? 'selected' : '' }}>Pesanan Berlangsung
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="bg-blue-950 text-white font-semibold px-3 py-2 rounded-lg text-xs">Submit</button>
                    </form>
                    {{-- order list --}}
                    @if (count($transactions) > 0)
                        @foreach ($transactions as $item)
                            <div class="w-full bg-white shadow-md rounded-lg border border-gray-300 p-4 my-2">
                                <div class="flex gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-shopping-bag">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                        <path d="M3 6h18" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                    <p class="text-black font-medium text-sm">Belanja</p>
                                    <p class="text-black text-sm">{{ formatDate($item->created_at) }}</p>
                                    @if ($item->status == 'Pesanan Selesai')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $item->status }}</span>
                                    @elseif($item->status == 'Menunggu Pembayaran')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $item->status }}</span>
                                    @elseif($item->status == 'Pesanan Diproses')
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $item->status }}</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $item->status }}</span>
                                    @endif
                                    <p class="text-gray-500  text-sm">{{ $item->no_trans }}</p>
                                </div>
                                <div class="flex justify-between items-end">
                                    {{-- data produk --}}
                                    <div class="grid grid-cols-4 gap-4">
                                        @foreach ($products[$item->no_trans] as $data)
                                            <div class="col-span-2 flex gap-5  items-center">
                                                <img class="rounded-lg w-32 h-20 mt-5"
                                                    src="data:image/png;base64,{{ $data->picture }}">
                                                <div class="flex flex-col">
                                                    <p class="text-black font-semibold">{{ $data->product }}</p>
                                                    <p class="text-gray-600 text-xs mb-3">{{ $data->qty }} barang x
                                                        Rp{{ str_replace(',', '.', number_format($data->price)) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- total harga transaksi --}}
                                    <div class="flex flex-col me-20">
                                        <p class="text-gray-600 text-xs">Total Belanja</p>
                                        <p class="text-black font-semibold">Rp
                                            {{ str_replace(',', '.', number_format($item->total_price)) }}</p>
                                    </div>
                                </div>

                                {{-- call to action --}}
                                <div class="flex justify-end items-center gap-5 mt-4">
                                    <div class="flex gap-1">
                                        @for ($i = 0; $i < $item->stars; $i++)
                                            <i class="cursor-pointer text-yellow-400 fas fa-star fa-xs"></i>
                                        @endfor
                                    </div>
                                    <a href="{{ route('orderDetail', ['no_trans' => $item->no_trans]) }}"
                                        class="text-blue-950 font-bold text-sm">Lihat Detail Transaksi</a>
                                    @if ($item->status == 'Pesanan Selesai' && $item->stars == '')
                                        <button onclick="showModal('{{ $item->no_trans }}')"
                                            data-modal-target="rating-modal" data-modal-toggle="rating-modal"
                                            class="bg-blue-950 text-white font-semibold py-2 px-4 rounded-lg text-sm">Beri
                                            Ulasan</button>
                                    @elseif($item->status == 'Pesanan Selesai' && $item->stars != '')
                                        <a href="{{ route('productList') }}"
                                            class="bg-blue-950 text-white font-semibold py-2 px-4 rounded-lg text-sm">Beli
                                            Lagi</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- informasi data kosong --}}
                        <div class="flex flex-col space-y-4 items-center justify-center h-full">
                            <p class="text-slate-800 text-lg text-center font-semibold mt-5">Data Pesanan masih kosong...
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <!-- feedback modal -->
    <div id="rating-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <form action="{{ route('orderFeedback') }}" method="post">
                    @csrf
                    <input type="hidden" name="stars" id="stars">
                    <input type="hidden" name="feedback" id="feedback">
                    <input type="hidden" name="no_trans" id="no_trans">
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-slate-900 font-semibold text-center text-lg">Beri rating untuk pesanan ini</p>
                        <div class="rating flex justify-center gap-5">
                            <i class="rating__star cursor-pointer text-yellow-400 far fa-star fa-lg"></i>
                            <i class="rating__star cursor-pointer text-yellow-400 far fa-star fa-lg"></i>
                            <i class="rating__star cursor-pointer text-yellow-400 far fa-star fa-lg"></i>
                            <i class="rating__star cursor-pointer text-yellow-400 far fa-star fa-lg"></i>
                            <i class="rating__star cursor-pointer text-yellow-400 far fa-star fa-lg"></i>
                        </div>
                        <p class="text-slate-900 font-semibold text-center text-lg" id="rating-text"></p>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Detail rating
                            pesanan</label>
                        <textarea id="message" rows="4" name="feedback_detail"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tuliskan disini detail rating anda...">-</textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan
                            ulasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script>
        $("#filterDate").flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            locale: "id",
            mode: "range",
        });

        function showModal(noTrans) {
            document.getElementById('no_trans').value = noTrans
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Apa Kamu Yakin?',
                text: "Kamu Tidak Dapat Mengembalikan Data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus ini!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
    {{-- function rating  --}}
    <script>
        const ratingStars = [...document.getElementsByClassName("rating__star")];
        const ratingResult = document.querySelector(".rating__result");
        const ratingText = document.querySelector("#rating-text");

        function executeRating(stars, result) {
            const starClassActive = "rating__star cursor-pointer text-yellow-400 fas fa-star fa-lg";
            const starClassUnactive = "rating__star cursor-pointer text-yellow-400 far fa-star fa-lg";
            const starsLength = stars.length;
            let i;
            stars.map((star) => {
                star.onclick = () => {
                    i = stars.indexOf(star) + 1;
                    if (star.className.indexOf(starClassUnactive) !== -1) {
                        printRatingResult(result, i);
                        for (i; i >= 0; --i) stars[i - 1].className = starClassActive;
                    } else {
                        printRatingResult(result, i);
                        for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
                    }
                };
            });
        }

        function printRatingResult(result, num = 0) {
            document.getElementById("stars").value = num
            switch (num) {
                case 0:
                    ratingText.textContent = ``;
                    break;
                case 1:
                    document.getElementById("feedback").value = `Sangat Mengecewakan`
                    ratingText.textContent = `Sangat Mengecewakan`;
                    break;
                case 2:
                    document.getElementById("feedback").value = `Mengecewakan`
                    ratingText.textContent = `Mengecewakan`;
                    break;
                case 3:
                    document.getElementById("feedback").value = `Biasa Saja`
                    ratingText.textContent = `Biasa Saja`;
                    break;
                case 4:
                    document.getElementById("feedback").value = `Cukup Puas`
                    ratingText.textContent = `Cukup Puas`;
                    break;
                case 5:
                    document.getElementById("feedback").value = `Sangat Puas`
                    ratingText.textContent = `Sangat Puas`;
                    break;
            }
        }

        executeRating(ratingStars, ratingResult);
    </script>
@endsection
