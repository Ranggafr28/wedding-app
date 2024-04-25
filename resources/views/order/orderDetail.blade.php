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
                    {{-- info pesanan --}}
                    <div class="w-full bg-white  border-b border-gray-300 p-4 my-2">
                        <div class="flex justify-between gap-3">
                            <p class="text-black font-medium text-lg mb-2">Info Pesanan</p>
                            <a href="{{ route('orderList') }}"
                                class="bg-blue-950 py-2 px-3 text-sm rounded-lg text-white font-medium">Kembali</a>
                        </div>
                        <div class="flex flex-col space-y-3">
                            <div class="flex w-full items-center">
                                <div class="w-1/6">
                                    <p class="text-gray-600 text-sm">Status Transaksi:</p>
                                </div>
                                <div class="w-auto">
                                    @switch($transactions->status)
                                        @case('Pesanan Selesai')
                                            <span
                                                class="bg-green-100 text-green-800 border border-green-600 capitalize text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $transactions->status }}</span>
                                        @break

                                        @case('Menunggu Pembayaran')
                                            <span
                                                class="bg-yellow-100 text-yellow-800 border border-yellow-600 capitalize text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $transactions->status }}</span>
                                        @break

                                        @case('Pesanan Dibatalkan')
                                            <span
                                                class="bg-red-100 text-red-800 border border-red-600 capitalize text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $transactions->status }}</span>
                                        @break

                                        @case('Pesanan Diproses')
                                            <span
                                                class="bg-blue-100 text-blue-800 border border-blue-600 capitalize text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $transactions->status }}</span>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="flex w-full items-center">
                                <div class="w-1/6">
                                    <p class="text-gray-600 text-sm">No Transaksi:</p>
                                </div>
                                <div class="w-3/4">
                                    <p class="text-black font-medium text-sm">{{ $transactions->no_trans }}</p>
                                </div>
                            </div>
                            <div class="flex w-full items-center">
                                <div class="w-1/6">
                                    <p class="text-gray-600 text-sm">Tanggal Acara:</p>
                                </div>
                                <div class="w-3/4">
                                    @if ($transactions->event_date)
                                        <p class="text-black font-medium text-sm">
                                            {{ formatDate($transactions->event_date) }}
                                        </p>
                                    @else
                                        <button type="button" data-modal-target="date-modal"
                                            data-modal-toggle="date-modal"
                                            class="py-2 px-3 rounded-lg bg-blue-900 text-white capitalize text-xs font-semibold">Atur
                                            tanggal</button>
                                    @endif
                                </div>
                            </div>
                            <div class="flex w-full items-center">
                                <div class="w-1/6">
                                    <p class="text-gray-600 text-sm">Alamat:</p>
                                </div>
                                <div class="w-3/4">
                                    @if ($transactions->event_address)
                                        <p class="text-black font-medium text-sm">{{ $user->fullname }}</p>
                                        <p class="text-gray-600 text-sm">62{{ $user->phone }}</p>
                                        <p class="text-gray-600 text-sm">
                                            {{ $transactions->event_address }}
                                        </p>
                                    @else
                                        <button type="button" data-modal-target="default-modal"
                                            data-modal-toggle="default-modal"
                                            class="py-2 px-3 rounded-lg bg-blue-900 text-white capitalize text-xs font-semibold">Atur
                                            alamat acara</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- info tagihan --}}
                    <div class="w-full bg-white p-4 my-2 border-b border-gray-300">
                        <p class="text-lg font-semibold mb-2 text-slate-800">Informasi Tagihan</p>
                        <div class="relative">
                            <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                                <thead class="text-xs text-white uppercase bg-blue-950">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No Transaksi
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            order id
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Pembayaran
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nominal / status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            tanggal bayar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $item)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-gray-900 text-center">
                                                {{ $item->no_trans }}
                                            </th>
                                            <td class="text-gray-800 py-4 text-center">
                                                {{ $item->order_id }}
                                            </td>
                                            <td class="text-gray-800 py-4 text-center">
                                                {{ $item->payment_name }}
                                            </td>
                                            <td class="text-gray-800 py-4 text-center">
                                                Rp{{ str_replace(',', '.', number_format($item->price)) }} /
                                                @if ($item->status == 'Lunas')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-1 py-0.5 rounded border border-green-400">{{ $item->status }}</span>
                                                @else
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-1 py-0.5 rounded border border-red-400">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td class="text-gray-800 py-4 text-center">
                                                {{ $item->payment_date != '' ? formatDate($item->payment_date) : '-' }}
                                            </td>
                                            <td class="py-4 text-center">
                                                @if ($item->status == 'Belum Bayar' && $transactions->status != 'Pesanan Dibatalkan')
                                                    @if ($item->payment_name == 'pembayaran 2')
                                                        @if ($diffInDays <= 7 && $diffInDays >= 0)
                                                            <form
                                                                action="{{ route('orderCreatePayment', ['no_trans' => $item->no_trans, 'orderId' => $item->order_id]) }}"
                                                                method="GET">
                                                                <button type="submit" id="pay-button1"
                                                                    class="bg-yellow-500 p-2 rounded-lg text-white text-sm font-semibold">Bayar
                                                                    Sekarang</button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <form
                                                            action="{{ route('orderCreatePayment', ['no_trans' => $item->no_trans, 'orderId' => $item->order_id]) }}"
                                                            method="GET">
                                                            <button type="submit" id="pay-button2"
                                                                class="bg-yellow-500 p-2 rounded-lg text-white text-sm font-semibold">Bayar
                                                                Sekarang</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="flex justify-end">
                                <div class="flex flex-col justify-end my-3">
                                    <p class="text-slate-700 font-semibold text-lg">Total Tagihan:
                                        Rp{{ str(str_replace(',', '.', number_format($transactions->total_price))) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- vendor list --}}
                    <div class="w-full bg-white p-4 my-2 border-b border-gray-300">
                        <p class="text-lg font-semibold mb-2 text-slate-800">List Vendor</p>
                        <div class="relative">
                            <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                                <thead class="text-xs text-white uppercase bg-blue-950">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Vendor
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Respon
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendor as $item)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="py-4 font-medium text-gray-900 text-center">
                                                {{ $item->fullname }}
                                            </th>
                                            <td class="py-4 text-center">
                                                @switch($item->approve)
                                                    @case('Bersedia')
                                                        <span
                                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded  border border-green-400">{{ $item->approve }}</span>
                                                    @break

                                                    @case('Tidak Bersedia')
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded  border border-red-400">{{ $item->approve }}</span>
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- order list --}}
                    <div id="accordion-collapse" data-accordion="collapse">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-gray-200 rounded-t-xl focus:ring-0 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span>Detail Produk List</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-gray-200">
                                <div class="grid grid-cols-4 gap-4">
                                    @foreach ($products as $data)
                                        <div class="col-span-2 flex gap-5  items-center">
                                            <img class="rounded-lg w-32 h-20 mt-5"
                                                src="data:image/png;base64,{{ $data->picture }}">
                                            <div class="flex flex-col">
                                                <p class="text-black font-semibold">{{ $data->product }}</p>
                                                <p class="text-gray-600 text-xs mb-3">{{ $data->qty }} barang x
                                                    Rp{{ str_replace(',', '.', number_format($data->price)) }}</p>
                                                <p class="text-gray-500 text-xs">Catatan:
                                                    {{ '"' . $data->product_note . '"' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal alamat --}}
                <div id="default-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-lg max-h-full">
                        <form action="{{ route('updateInfo') }}" method="POST">
                            @csrf
                            <input type="hidden" name="update" value="address">
                            <input type="hidden" name="no_trans" value="{{ $transactions->no_trans }}">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-4 md:p-5">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat
                                        Lengkap</label>
                                    <textarea id="event_address" rows="4" name="event_address" required
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-blue-500"
                                        placeholder="Tuliskan alamat lengkap disini..."></textarea>
                                    <p id="addressErrorMessage" class="text-xs text-red-600"></p>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" id="btn_event_address"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        simpan</button>
                                    <button data-modal-hide="default-modal" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batalkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- modal tanggal --}}
                <div id="date-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <form action="{{ route('updateInfo') }}" method="POST">
                            @csrf
                            <input type="hidden" name="update" value="eventDate">
                            <input type="hidden" name="no_trans" value="{{ $transactions->no_trans }}">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-4 md:p-5">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Atur
                                        tanggal
                                        acara</label>
                                    <input type="text" id="eventDate" name="event_date"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5"
                                        placeholder="Masukan tanggal..." required />
                                    <p id="dateErrorMessage" class="text-xs text-red-600"></p>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" id="btn_eventDate"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        simpan</button>
                                    <button data-modal-hide="date-modal" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batalkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script>
        $(document).ready(() => {
            // config flatpickr untuk menentukan tanggal acara
            $('#eventDate').flatpickr({
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
                locale: 'id'
            });
            // validasi jika alamat acara dan tanggal acara masih kosong tombol bayar akan disabled
            const eventDate = "{{ $transactions->event_date }}"
            const eventAddress = "{{ $transactions->event_address }}"
            if (eventDate.trim() === '' || eventAddress.trim() === '') {
                // Jika eventDate kosong, nonaktifkan tombol
                $('#pay-button1').addClass('opacity-50 cursor-not-allowed');
                $('#pay-button1').prop('disabled', true);
                $('#pay-button2').addClass('opacity-50 cursor-not-allowed');
                $('#pay-button2').prop('disabled', true);
            }
        });

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
@endsection
