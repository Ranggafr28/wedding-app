<div>
    <div class="flex">
        {{-- card list produk --}}
        <div class="w-3/5 px-6 py-6 mx-auto">
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5 min-h-96 h-full">
                        <p class="text-xl mb-4 text-slate-900 font-semibold">Keranjang</p>
                        @if (count($cart) > 0)
                            {{-- list group produk --}}
                            <div class="h-full">
                                @foreach ($cart as $product)
                                    <div
                                        class="w-full text-sm font-medium text-gray-900 bg-white border-b border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 focus:outline-none">
                                        <div class="flex justify-between items-center w-full px-4 py-2">
                                            <div class="flex gap-5 items-center">
                                                {{-- checkbox product --}}
                                                <input type="checkbox" id="checkboxProduct-{{ $product->kode_produk }}"
                                                    onclick="addProducts('{{ $product->product_picture }}','{{ $product->kode_produk }}','{{ $product->product_name }}','{{ $product->qty }}','{{ $product->product_price }}', '{{ $product->remark }}')"
                                                    class="w-5 h-5 font-semibold text-blue-950 bg-gray-100 border-gray-300 rounded focus:ring-0 cursor-pointer">
                                                {{-- image product --}}
                                                <img src="data:image/png;base64,{{ $product->product_picture }}"
                                                    class="h-14 w-24 rounded-lg" alt="">
                                                <p class="font-medium text-slate-900">{{ $product->product_name }}</p>
                                            </div>
                                            <div class="flex flex-col space-y-4 space-x-3">
                                                <p class="text-right text-md text-slate-950 font-medium">
                                                    Rp{{ str_replace(',', '.', number_format($product->product_price)) }}
                                                </p>
                                                <div class="flex gap-2 text-gray-700">
                                                    {{-- button trigger tooltip catatan --}}
                                                    <button class="p-3 flex gap-2" data-modal-target="default-modal"
                                                        onclick="modalNotes({{ $product }})"
                                                        data-modal-toggle="default-modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-notebook-pen">
                                                            <path
                                                                d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                                                            <path d="M2 6h4" />
                                                            <path d="M2 10h4" />
                                                            <path d="M2 14h4" />
                                                            <path d="M2 18h4" />
                                                            <path d="M18.4 2.6a2.17 2.17 0 0 1 3 3L16 11l-4 1 1-4Z" />
                                                        </svg>
                                                    </button>
                                                    {{-- button trigger hapus data produk dalam cart --}}
                                                    <button
                                                        wire:click.prevent="deleteProduct('{{ $product->kode_produk }}')"
                                                        class="p-3"><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-trash-2">
                                                            <path d="M3 6h18" />
                                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                            <line x1="10" x2="10" y1="11"
                                                                y2="17" />
                                                            <line x1="14" x2="14" y1="11"
                                                                y2="17" />
                                                        </svg></button>
                                                    {{-- button quantity --}}
                                                    <div class="w-34">
                                                        <div class="relative flex items-center max-w-[8rem] group">
                                                            {{-- button decrement qty --}}
                                                            <button
                                                                wire:click.prevent="updateQty('{{ $product->kode_produk }}', 'decrement')"
                                                                type="button" id="decrement-button"
                                                                data-input-counter-decrement="quantity-input"
                                                                class="text-blue-950 bg-white border-l border-y border-gray-300 rounded-s-lg p-3 h-9 focus:ring-0 focus:outline-none">
                                                                <svg class="w-3 h-3 text-blue-950" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 2">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M1 1h16" />
                                                                </svg>
                                                            </button>
                                                            <input type="text" id="quantity-input" data-input-counter
                                                                data-input-counter-min="0"
                                                                aria-describedby="helper-text-explanation"
                                                                class="border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-0 focus:ring-blue-500 focus:border-y block w-full py-2.5"
                                                                placeholder="0" value="{{ $product->qty }}" readonly />
                                                            {{-- button increment qty --}}
                                                            <button type="button"
                                                                wire:click.prevent="updateQty('{{ $product->kode_produk }}', 'increment')"
                                                                id="increment-button"
                                                                data-input-counter-increment="quantity-input"
                                                                class="text-blue-950 bg-white border-r border-y border-gray-300 rounded-e-lg p-3 h-9 focus:ring-0 focus:outline-none">
                                                                <svg class="w-3 h-3 text-blue-950" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 1v16M1 9h16" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <small
                                                            class="{{ $product->qty > 0 ? 'hidden' : 'block ' }} text-red-500 text-xs flex justify-end">Min.
                                                            beli 1</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 ms-10 my-1 ">
                                            {{ 'Catatan: ' . $product->remark }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- informasi jika keranjang kosong --}}
                            <div class="flex flex-col space-y-4 items-center justify-center h-full">
                                <p class="text-slate-800 text-lg text-center font-semibold">Keranjang belanja masih
                                    kosong
                                    nih...</p>
                                <a href="{{ route('productList') }}"
                                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-4 rounded-lg font-semibold">Mulai
                                    Belanja</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- modal alamat --}}
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-lg max-h-full">
                    <form action="{{ route('noteProduct') }}" method="POST">
                        @csrf
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <input type="text" class="hidden" id="codeProduct" name="codeProduct">
                            <div class="p-4 md:p-5 space-y-4">
                                <label for="remark" class="block mb-2 text-sm font-medium text-gray-900">Catatan
                                    Produk</label>
                                <textarea id="remark" rows="4" name="remark"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-blue-500"
                                    placeholder="Tuliskan catatan barang disini..."></textarea>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    simpan</button>
                                <button data-modal-hide="default-modal" type="button"
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
                            <p class="text-slate-800 font-semibold">Keranjang Belanja</p>
                            {{-- total jumlah jenis barang yang dipilih --}}
                            <p class="text-slate-800 font-semibold" id="totalProducts"></p>
                        </div>
                        {{-- tabel detail produk --}}
                        <div class="relative">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase">
                                    <tr>
                                        <th scope="col" class="py-3 text-left">
                                            Barang
                                        </th>
                                        <th scope="col" class="py-3 text-center">
                                            Qty
                                        </th>
                                        <th scope="col" class="py-3 text-right">
                                            harga
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                                <tfoot id="table-footer">
                                </tfoot>
                            </table>
                        </div>
                        {{-- button checkout --}}
                        <button wire:click="processingCheckout(ProductsArr)"
                            class="bg-blue-950 w-full rounded-lg py-2 mt-3 text-white font-medium flex justify-center gap-3"><svg
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-shopping-cart">
                                <circle cx="8" cy="21" r="1" />
                                <circle cx="19" cy="21" r="1" />
                                <path
                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                            </svg>Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // array penampung list produk yang dipilih
        let ProductsArr = []
        // function untuk menambahkan titik pada format rupiah
        function numberWithDotes(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        // function untuk merubah value integer menjadi rupiah
        function get_nominal(e) {
            let nominal = e.replace(/\D/g, '');
            return 'Rp. ' + numberWithDotes(nominal);
        }

        function modalNotes(data) {
            $('#default-modal').removeClass('hidden');
            document.getElementById('codeProduct').value = data.kode_produk;
            document.getElementById('remark').value = data.remark;
        }
        // function untuk menyimpan data produk terpilih kedalam array
        function addProducts(productImage, codeProduct, productName, productQty, productPrice, productNote) {
            const checkboxProduct = document.getElementById('checkboxProduct-' + codeProduct).checked
            const tableBody = document.getElementById('table-body');
            const tableFooter = document.getElementById('table-footer');

            // object penampung data mentah untuk dimasukan kedalam array
            const obj = {
                codeProduct: codeProduct,
                productName: productName,
                productQty: productQty,
                productPrice: productPrice,
                productImage: productImage,
                productNote: productNote,
            }
            // pengkondisian jika checkbox di ceklis maka data akan di tambahkan kedalam array penampung
            // dan jika checkbox tidak diceklis maka data produk yang di uncheck akan di hapus di dalam array
            if (checkboxProduct) {
                ProductsArr.push(obj)
            } else {
                ProductsArr = ProductsArr.filter(item => item.codeProduct !== codeProduct);
            }
            // mengirimkan data total jenis barang  yang di pilih ke tag HTML yang memiliki id totalProducts
            document.getElementById('totalProducts').innerHTML = ProductsArr.length + " Barang"

            tableBody.innerHTML = '';
            tableFooter.innerHTML = '';

            // Tambahkan baris baru untuk setiap produk dalam array products
            let totalHarga = 0;
            let totalQty = 0;
            // tabel list produk barang yang akan di checkout
            ProductsArr.forEach(item => {
                totalHarga += item.productPrice * item.productQty;
                totalQty += parseInt(item.productQty);
                const row = document.createElement('tr');
                row.classList.add('bg-white', 'border-b', 'text-xs');

                const productCell = document.createElement('td');
                productCell.textContent = item.productName;
                productCell.classList.add('py-4', 'font-medium', 'text-gray-900')

                const qtyCell = document.createElement('td');
                qtyCell.textContent = item.productQty;
                qtyCell.classList.add('py-4', 'text-center')

                const priceCell = document.createElement('td');
                priceCell.textContent = get_nominal(item.productPrice);
                priceCell.classList.add('py-4', 'text-right', 'font-semibold')

                row.appendChild(productCell);
                row.appendChild(qtyCell);
                row.appendChild(priceCell);

                tableBody.appendChild(row);
            });

            // tabel footer untuk menampilkan data total
            const row = document.createElement('tr');
            row.classList.add('font-semibold', 'text-gray-900', 'border-t', 'border-gray-300');

            const titleCell = document.createElement('td');
            titleCell.textContent = 'TOTAL';
            titleCell.classList.add('text-right', 'py-3', 'text-base')

            const totalQtyCell = document.createElement('td');
            totalQtyCell.textContent = totalQty;
            totalQtyCell.classList.add('py-4', 'text-center')

            const totalCell = document.createElement('td');
            totalCell.textContent = get_nominal(totalHarga.toString());
            totalCell.classList.add('py-4', 'text-right', 'font-semibold')

            row.appendChild(titleCell);
            row.appendChild(totalQtyCell);
            row.appendChild(totalCell);

            tableFooter.appendChild(row);
        }
    </script>
</div>
