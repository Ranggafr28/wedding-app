@extends('layout.index')
@section('content')
    <nav class="absolute z-20 flex flex-wrap items-center justify-between w-full px-6 py-2 -mt-56 text-white transition-all ease-in shadow-none duration-250 lg:flex-nowrap lg:justify-start"
        navbar-profile navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-6 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 pl-2 pr-4 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="leading-normal text-sm">
                        <a class="opacity-50" href="javascript:;">Dashboard</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal before:float-left before:pr-2 before:content-['/']"
                        aria-current="page">Profile</li>
                </ol>
                <h6 class="mb-2 ml-2 font-bold text-white capitalize">Profile</h6>
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

    <div class="relative w-full mx-auto mt-60 ">
        <div
            class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 shadow-3xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div
                        class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                        <img src="data:image/png;base64,{{ $user->avatar }}" alt="profile_image"
                            class="w-full shadow-2xl rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1">{{ $user->fullname }}</h5>
                        <p class="mb-0 font-semibold leading-normal text-sm capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    <div class="relative right-0">
                        <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl ">
                            <li class="z-30 flex-auto text-center cursor-pointer" onclick="toggle()">
                                <a id="btnProfile"
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-l-lg bg-blue-900 text-white">
                                    <i class="fa fa-address-card" aria-hidden="true"></i>
                                    <span class="ml-2">Profil</span>
                                </a>
                            </li>
                            <li class="z-30 flex-auto text-center cursor-pointer" onclick="toggle('password')">
                                <a id="btnPassword"
                                    class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-r-lg bg-slate-200 text-slate-700">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ml-2">Ubah Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('updateProfile'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: 'Profile updated successfully',
            })
        </script>
    @endif
    @if (session()->has('updatePassword'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: 'Password updated successfully',
            })
        </script>
    @endif
    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                {{-- Form edit Profile --}}
                <div id="editProfile"
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">

                    <form method="POST" action="{{ route($route . '.update', [$route => auth()->user()->user_id]) }}"
                        class=" border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        @method('PUT')
                        @csrf
                        <div class="flex items-center">
                            <p class="mb-0">Ubah Profil</p>
                            <button type="submit"
                                class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-900 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
                        </div>
                        <p class="leading-normal uppercase text-sm">Informasi User</p>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="fullname"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama
                                        Lengkap</label>
                                    <input type="text" name="fullname" value='{{ $user->fullname }}'
                                        placeholder="Masukan nama lengkap..."
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="phone"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nomor HP</label>
                                    <input type="number" name="phone" value='{{ '0' . $user->phone }}'
                                        placeholder="Masukan nomor hp..."
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="email"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                    <input type="email" name="email" value='{{ $user->email }}'
                                        placeholder="Masukan email..."
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            @if (auth()->user()->role == 'vendor')
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="category"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kategori
                                            vendor</label>
                                        <select id="category" name="category" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($category as $item)
                                                <option class="capitalize"
                                                    {{ $item->category == $user->category ? 'selected' : '' }}
                                                    value="{{ $item->category }}">
                                                    {{ $item->category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr
                            class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent" />

                        <p class="leading-normal uppercase text-sm">Informasi Lainnya</p>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                <div class="mb-4">
                                    <label for="alamat"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Alamat</label>
                                    <input type="text" name="address" value='{{ $user->address }}'
                                        placeholder="Masukan alamat user..."
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-1/2 md:flex-0">
                                <div class="mb-4">
                                    <label for="city"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kota</label>
                                    <input type="text" name="city" value='{{ $user->city }}'
                                        placeholder="Masukan nama kota..."
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-1/2 md:flex-0">
                                <div class="mb-4">
                                    <label for="country"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Negara</label>
                                    <input type="text" name="country" value="{{ $user->country }}"
                                        placeholder="Masukan nama negara..." readonly
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- form ubah password --}}
                <div id="changePassword"
                    class=" hidden relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <form method="POST" action="{{ route($route . '.update', [$route => auth()->user()->user_id]) }}"
                        class=" border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        @method('PUT')
                        @csrf
                        <div class="flex items-center">
                            <p class="mb-0">Ubah Password</p>
                            <button type="submit"
                                class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-900 border-0 rounded-lg shadow-md cursor-pointer text-xs tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
                        </div>
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                    <label for="password"
                                        class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Password
                                        Baru</label>
                                    <input type="password" name="password" placeholder="Masukan password baru"
                                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                    <small>Kosongkan jika tidak ingin mengubah password</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/bg-profile.jpg') }}"
                        alt="profile cover image">
                    <div class="flex flex-wrap justify-center -mx-3">
                        <div class="w-4/12 max-w-full px-3 flex-0 ">
                            <div class="mb-6 -mt-6 lg:mb-0 lg:-mt-16">
                                <form method="POST" id="changeProfile"
                                    action="{{ route($route . '.update', [$route => auth()->user()->user_id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" class="hidden" name="avatar" id="avatar"
                                        accept=".png, .jpg, .jpeg, .webp">
                                    <label class="relative" for="avatar">
                                        <img class="cursor-pointer h-auto max-w-full border-2 h-48 w-48 border-white border-solid rounded-circle grayscale-0 hover:grayscale"
                                            src="data:image/png;base64,{{ $user->avatar }}" alt="profile image">
                                        <!-- Teks "Ubah Profile" -->
                                        <div
                                            class="cursor-pointer absolute rounded-full top-0 left-0 right-0 bottom-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-50 transition duration-300">
                                            <p class="text-white text-xs font-bold">Ubah Foto</p>
                                        </div>
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-6 pt-0">
                        <div class="mt-6 text-center">
                            <h5 class="text-slate-900 font-medium">
                                {{ $user->fullname }}<br />
                                <span class="font-light">, {{ $user->email }}</span>
                            </h5>
                            <div class="mb-2 font-semibold leading-relaxed text-base text-slate-700">
                                <i class="mr-2  ni ni-pin-3"></i>
                                {{ $user->city != '' ? $user->city : '-' }}, Indonesia
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function toggle(section) {
            const changePassword = document.getElementById('changePassword')
            const editProfile = document.getElementById('editProfile')
            const btnProfile = document.getElementById('btnProfile')
            const btnPassword = document.getElementById('btnPassword')

            if (section == 'password') {
                editProfile.classList.add('hidden');
                changePassword.classList.remove('hidden');
                btnPassword.classList.add('bg-blue-900', 'text-white');
                btnPassword.classList.remove('bg-slate-200', 'text-slate-700');
                btnProfile.classList.remove('bg-blue-900', 'text-white');
                btnProfile.classList.add('bg-slate-200', 'text-slate-700');
            } else {
                editProfile.classList.remove('hidden');
                changePassword.classList.add('hidden');
                btnPassword.classList.add('bg-slate-200', 'text-slate-700');
                btnPassword.classList.remove('bg-blue-900', 'text-white');
                btnProfile.classList.add('bg-blue-900', 'text-white');
                btnProfile.classList.remove('bg-slate-200', 'text-slate-700');
            }
        }

        $(document).ready(() => {
            var uploadImage = document.getElementById('avatar')
            uploadImage.addEventListener('change', function() {
                Swal.fire({
                    title: 'Apa Kamu Yakin?',
                    text: "Ingin Mengubah Foto Profile",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah foto!'
                }).then((result) => {
                    if (result.value) {
                        document.getElementById('changeProfile').submit();
                    }
                });
            })

        })
    </script>
@endsection
