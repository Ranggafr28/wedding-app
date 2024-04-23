<div>
    {{-- card content --}}
    <div class="flex">
        {{-- card detail pesanan --}}
        <div class="w-3/5 px-6 py-6 mx-auto">
            <div class="flex flex-wrap mt-6 -mx-3 space-y-4">
                {{-- card alamat  --}}
                <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                        <div class="flex flex-col space-y-3">
                            <div class="">
                                <p class="text-lg text-slate-700 font-semibold">Tanggal Acara</p>
                                <p class="">
                                    {{ $transaction->event_date ? $tanggalAcara : '(Tanggal acara belum diisi)' }}
                                </p>
                            </div>
                            <div class="">
                                <p class="text-lg text-slate-700 font-semibold">Alamat</p>
                                <p class="">
                                    {{ $transaction->event_address ? $transaction->event_address : '(Alamat acara belum diisi)' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-5 mt-3">
                            <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                class="py-2 px-3 rounded-lg bg-blue-900 text-white capitalize text-xs font-semibold">Ubah
                                Alamat</button>
                            <button type="button" data-modal-target="date-modal" data-modal-toggle="date-modal"
                                class="py-2 px-3 rounded-lg bg-blue-900 text-white capitalize text-xs font-semibold">Atur
                                Tanggal</button>
                        </div>

                    </div>
                </div>
                {{-- card produk list --}}
                <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($list_product as $item)
                            @php
                                $totalPrice += $item['productQty'] * $item['productPrice'];
                            @endphp
                            <div class="grid grid-cols-5 gap-4  place-items-stretch border-b border-gray-200 py-2 px-5">
                                <div class="col-span-1">
                                    <img src="data:image/png;base64,{{ $item['productImage'] }}" alt=""
                                        class="h-15 w-25 rounded-lg">
                                </div>
                                <div class="col-span-2">
                                    <p class="text-black ">{{ $item['productName'] }}</p><br />
                                    <p class="text-sm text-gray-500 font-medium mb-1 ">
                                        {{ $item['productNote'] != '' ? '"' . $item['productNote'] . '"' : '' }}</p>
                                </div>
                                <div class="col-span-2 text-right">
                                    <p class="text-black font-semibold">
                                        {{ $item['productQty'] . ' x Rp ' . str_replace(',', '.', number_format($item['productPrice'])) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
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
                        <input type="hidden" name="no_trans" value="{{ $no_trans }}">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-4 md:p-5">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat
                                    Lengkap</label>
                                <textarea id="event_address" rows="4" name="event_address" required
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-blue-500"
                                    placeholder="Tuliskan alamat lengkap disini...">{{ $transaction->event_address }}</textarea>
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
                        <input type="hidden" name="no_trans" value="{{ $no_trans }}">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-4 md:p-5">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Atur tanggal
                                    acara</label>
                                <input type="text" id="eventDate" name="event_date"
                                    value="{{ $transaction->event_date }}"
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
        {{-- card kalkulasi harga --}}
        <div class="w-2/5 px-6 py-6 mx-auto">
            <!-- cards row 2 -->
            <div class="flex flex-col flex-wrap mt-6 -mx-3 space-y-5">
                <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                        <div class="flex justify-between border-b border-gray-300 pb-3">
                            <p class="text-slate-800 font-semibold">Ringkasan Belanja</p>
                            {{-- total jumlah jenis barang yang dipilih --}}
                            <p class="text-slate-800 font-semibold" id="totalProducts"></p>
                        </div>
                        <ul class="w-full text-sm font-medium text-gray-900 bg-white rounded-lg mt-2">
                            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg flex justify-between">
                                <p class="text-gray-700">Total Harga</p>
                                <p class="text-slate-900">Rp {{ str_replace(',', '.', number_format($totalPrice)) }}
                                </p>
                            </li>
                            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg flex justify-between">
                                <p class="text-gray-700">DP (50%)</p>
                                <p class="text-slate-900">Rp
                                    {{ str_replace(',', '.', number_format($totalPrice / 2)) }}
                                </p>
                            </li>
                            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg flex justify-between">
                                <p class="text-gray-700">Sisa Pembayaran</p>
                                <p class="text-slate-900">Rp
                                    {{ str_replace(',', '.', number_format($totalPrice / 2)) }}
                                </p>
                            </li>
                        </ul>
                        {{-- button checkout --}}
                        <button id="pay-button"
                            class="bg-blue-950 w-full rounded-lg py-2 mt-3 text-white font-medium flex justify-center gap-3"><svg
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-shopping-cart">
                                <circle cx="8" cy="21" r="1" />
                                <circle cx="19" cy="21" r="1" />
                                <path
                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                            </svg>Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- handle Midtrans response --}}
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', () => {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    $.ajax({
                        url: "{{ route('responseMidtrans') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: result,
                        dataType: 'json',
                        success: function(response) {
                            window.location.href = "{{ route('transactionSuccess') }}"
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    })
                },
                onPending: function(result) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: "{{ route('responseMidtrans') }}",
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: result,
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = "{{ route('cart') }}"
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            })
                        }
                    });
                },
                onError: function(result) {
                    return console.log(result);
                    /* You may add your own implementation here */
                    $.ajax({
                        url: "{{ route('responseMidtrans') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: result,
                        dataType: 'json',
                        success: function(response) {
                            window.location.href = "{{ route('transactionFailed') }}"
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    })
                },
                onClose: function() {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        text: "Anda telah menutup popup tanpa melakukan pembayaran",
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
        })
    </script>
    <script>
        $(document).ready(() => {
            $('#eventDate').flatpickr({
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
                locale: 'id'
            });
            // validasi jika tanggal dan alamat belum diisi maka tombol bayar disabled
            const eventDate = "{{ $transaction->event_date }}"
            const eventAddress = "{{ $transaction->event_address }}"
            if (eventDate.trim() === '' || eventAddress.trim() === '') {
                // Jika eventDate kosong, nonaktifkan tombol
                $('#pay-button').addClass('opacity-50 cursor-not-allowed');
                $('#pay-button').prop('disabled', true);
            }
            // validasi form alamat
            $('#event_address').on('keyup', () => {
                if ($('#event_address').val().trim().length > 5) {
                    $('#event_address').removeClass('focus:border-red-500 bg-red-100');
                    $('#btn_event_address').removeClass('opacity-50 cursor-not-allowed');
                    $('#btn_event_address').prop('disabled', false);
                    $('#addressErrorMessage').html('');
                } else if ($('#event_address').val().trim().length > 0 && $('#event_address').val().trim()
                    .length < 6) {
                    $('#event_address').addClass('focus:border-red-500 bg-red-100');
                    $('#btn_event_address').addClass('opacity-50 cursor-not-allowed');
                    $('#btn_event_address').prop('disabled', true);
                    $('#addressErrorMessage').html('Alamat diisi minimal 6 karakter');
                } else {
                    $('#event_address').addClass('focus:border-red-500 bg-red-100');
                    $('#btn_event_address').addClass('opacity-50 cursor-not-allowed');
                    $('#btn_event_address').prop('disabled', true);
                    $('#addressErrorMessage').html('Alamat tidak boleh kosong');
                }
            });
            $('#eventDate').on('change', () => {
                if ($('#eventDate').val() != '') {
                    $('#eventDate').removeClass('focus:border-red-500 bg-red-100');
                    $('#btn_eventDate').removeClass('opacity-50 cursor-not-allowed');
                    $('#btn_eventDate').prop('disabled', false);
                    $('#dateErrorMessage').html('');
                } else {
                    $('#eventDate').addClass('focus:border-red-500 bg-red-100');
                    $('#btn_eventDate').addClass('opacity-50 cursor-not-allowed');
                    $('#btn_eventDate').prop('disabled', true);
                    $('#dateErrorMessage').html('Tanggal tidak boleh kosong');
                }
            })
        })
        // function untuk menambahkan titik pada format rupiah
        function numberWithDotes(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        // function untuk merubah value integer menjadi rupiah
        function get_nominal(e) {
            let nominal = e.replace(/\D/g, '');
            return 'Rp. ' + numberWithDotes(nominal);
        }
    </script>
</div>
