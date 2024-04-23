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
    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-xl border-0 border-solid bg-white bg-clip-border p-5">
                    {{-- filter view --}}
                    <div class="flex justify-between w-full items-center ">
                        <form class="w-1/3" action="{{ route($route . '.index') }}" method="GET">
                            <div class="relative">
                                <input type="text" name="search" id="default-search" value="{{ $params }}"
                                    class="block w-full py-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-blue-950"
                                    placeholder="Cari nama role ..." />
                                <button type="submit"
                                    class="absolute end-2.5 bottom-2 font-medium rounded-lg text-sm px-4 py-2"><svg
                                        class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg></button>
                            </div>
                        </form>
                        <a href="{{ route($route . '.create') }}"
                            class="bg-blue-950 py-2 px-3 text-sm rounded-lg text-white font-medium">Tambah
                            Data</a>
                    </div>
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
                    {{-- table --}}
                    <div class="relative overflow-x-hidden shadow-lg sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-800 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-2 py-3 text-center">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Act
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas => $item)
                                    <tr class="bg-gray-100 border-b hover:bg-gray-200 text-gray-900">
                                        <th scope="row" class="px-2 py-4 font-medium text-center">
                                            {{ $datas + $data->firstItem() }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->role }}
                                        </td>
                                        <td class="px-6 py-4 text-center w-32">
                                            <div class="grid grid-cols-2 gap-5">
                                                <a href="{{ route($route . '.edit', ['role' => $item->id]) }}"
                                                    class="bg-yellow-600 text-white p-2 rounded-lg w-fit"><svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path
                                                            d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                        <path
                                                            d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                                    </svg>
                                                </a>
                                                <button onclick="deleteData({{ $item->id }})"
                                                    class="bg-red-700 text-white p-2 rounded-lg w-fit"><svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route($route . '.destroy', [$route => $item->id]) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($data->isEmpty())
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 text-center"
                                            colspan="3">
                                            Data tidak ada
                                        </th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class=" my-5 px-5 dark:text-white">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
    <script>
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
