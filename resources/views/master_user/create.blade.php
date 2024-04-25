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
                    <form action="{{ route($route . '.store') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="grid grid-cols-4 gap-5 mt-5">
                            <div class="mb-5">
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="text" id="username" name="username"
                                    class="@error('username') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5"
                                    placeholder="Masukan username.." />
                                @error('username')
                                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <div class="relative">
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <div class="flex items-center">
                                        <input type="password" id="passwordField" name="password"
                                            class="focus text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-950 focus:ring-0 pe-10"
                                            placeholder="password">
                                        <button type="button" onclick="showPassword()" id="showPasswordButton"
                                            class="cursor-pointer absolute inset-y-0 right-0 top-6 flex items-center pe-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                                <path
                                                    d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                                <path
                                                    d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div id="message" class="text-xs text-red-600 mt-1 hidden"><span
                                        id="strenghtMeter"></span></div>
                            </div>
                            <div class="mb-5">
                                <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                    Lengkap</label>
                                <input type="text" id="fullname" name="fullname"
                                    class="@error('fullname') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5"
                                    placeholder="Masukan nama lengkap.." />
                                @error('fullname')
                                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" id="email" name="email"
                                    class="@error('email') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5"
                                    placeholder="Masukan email.." />
                                @error('email')
                                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Nomor
                                    HP</label>
                                <input type="number" id="phone" name="phone"
                                    class="@error('phone') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan nomor HP.." />
                                @error('phone')
                                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                <select id="role" name="role"
                                    class="@error('role') is-invalid border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-blue-950 block w-full p-2.5">
                                    <option selected disabled>Pilih Role</option>
                                    @foreach ($role as $item)
                                        <option class="capitalize" value="{{ $item->role }}">{{ $item->role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" id="btn-submit"
                                class="bg-green-600 px-4 py-2 text-white rounded-lg text-sm font-medium">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script src="{{ asset('assets/js/passwordMeter.js') }}" async></script>
    <script src="{{ asset('assets/js/showPassword.js') }}" async></script>
@endsection
