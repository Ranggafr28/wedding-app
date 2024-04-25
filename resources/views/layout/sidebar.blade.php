<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-hidden antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('dashboard') }}">
            <img src="{{asset('assets/img/logos/android-chrome-512x512.png')}}"
                class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-10" alt="main_logo" />
            <img src="{{asset('assets/img/logos/android-chrome-512x512.png')}}"
                class="hidden h-full max-w-full transition-all duration-200 ease-nav-brand max-h-10" alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Suci Wedding Organizer</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto h-full pb-14 overflow-y-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-10">
            <li class="mt-0.5 w-full">
                <a class="{{ $modul == 'Dashboard' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('dashboard') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>
            {{-- List Menu Master Data dan Transaksi --}}
            @if (auth()->user()->role == 'administrator' || auth()->user()->role == 'vendor')
                {{-- List Menu Master Data --}}
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Master Data
                    </h6>
                </li>
                @if (auth()->user()->role == 'administrator')
                    <li class="mt-0.5 w-full">
                        <a class="{{ $modul == 'Master User' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                            href="{{ route('user.index') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Master User</span>
                        </a>
                    </li>
                    <li class="mt-0.5 w-full">
                        <a class="{{ $modul == 'Master Role' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                            href="{{ route('role.index') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Master Role</span>
                        </a>
                    </li>
                    <li class="mt-0.5 w-full">
                        <a class="{{ $modul == 'Master Kategori' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                            href="{{ route('category.index') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Master Kategori</span>
                        </a>
                    </li>
                @endif
                <li class="mt-0.5 w-full">
                    <a class="{{ $modul == 'Master Produk' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('product.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Master Produk</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="{{ $modul == 'Detail Products' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('gallery-list.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Brosur Produk</span>
                    </a>
                </li>
                {{-- List Menu Transaksi --}}
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Transaksi
                    </h6>
                </li>
                @if (auth()->user()->role == 'administrator')
                    <li class="mt-0.5 w-full">
                        <a class="{{ $modul == 'Transaksi Approval' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                            href="{{ route('transactionList') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">List Transaksi</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->role == 'vendor')
                    <li class="mt-0.5 w-full">
                        <a class="{{ $modul == 'Persetujuan Transaksi' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                            href="{{ route('transactionApproval') }}">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Persetujuan
                                Transaksi</span>
                        </a>
                    </li>
                @endif
            @endif
            {{-- List Menu Pesanan --}}
            @if (auth()->user()->role == 'customer')
                {{-- List Menu Pesanan --}}
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Pesanan
                    </h6>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="{{ $modul == 'List Produk' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('productList') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">List Produk</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="{{ $modul == 'order' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('orderList') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pesanan Saya</span>
                    </a>
                </li>
            @endif
            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Profil User
                </h6>
            </li>
            <li class="mt-0.5 w-full">
                <a class="{{ $modul == 'Profile' ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('profile.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile User</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
