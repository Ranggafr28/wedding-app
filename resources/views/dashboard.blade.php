@extends('layout.index')
@section('content')
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="false">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm capitalize leading-normal text-white" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
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
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">
                                        Today's Money</p>
                                    <h5 class="mb-2 font-bold">$53,000</h5>
                                    <p class="mb-0">
                                        <span class="text-sm font-bold leading-normal text-emerald-500">+55%</span>
                                        since yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                    <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">
                                        Today's Users</p>
                                    <h5 class="mb-2 font-bold">2,300</h5>
                                    <p class="mb-0">
                                        <span class="text-sm font-bold leading-normal text-emerald-500">+3%</span>
                                        since last week
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                    <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">
                                        New Clients</p>
                                    <h5 class="mb-2 font-bold">+3,462</h5>
                                    <p class="mb-0">
                                        <span class="text-sm font-bold leading-normal text-red-600">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card4 -->
            <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase">
                                        Sales</p>
                                    <h5 class="mb-2 font-bold">$103,430</h5>
                                    <p class="mb-0">
                                        <span class="text-sm font-bold leading-normal text-emerald-500">+5%</span>
                                        than last month
                                    </p>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize">Sales overview</h6>
                        <p class="mb-0 text-sm leading-normal">
                            <i class="fa fa-arrow-up text-emerald-500"></i>
                            <span class="font-semibold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="flex-auto p-4">
                        <div>
                            <canvas id="chart-line" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                    <!-- slide 1 -->
                    <div slide class="absolute w-full h-full transition-all duration-500">
                        <img class="object-cover h-full" src="{{ asset('') }}assets/img/carousel-1.jpg"
                            alt="carousel image" />
                        <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                            <div
                                class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                <i class="top-0.75 text-xxs relative text-slate-700 ni ni-camera-compact"></i>
                            </div>
                            <h5 class="mb-1 text-white">Get started with Argon</h5>
                            <p class="">There’s nothing I really wanted to do in life that I wasn’t
                                able to get good at.</p>
                        </div>
                    </div>

                    <!-- slide 2 -->
                    <div slide class="absolute w-full h-full transition-all duration-500">
                        <img class="object-cover h-full" src="{{ asset('') }}assets/img/carousel-2.jpg"
                            alt="carousel image" />
                        <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                            <div
                                class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                <i class="top-0.75 text-xxs relative text-slate-700 ni ni-bulb-61"></i>
                            </div>
                            <h5 class="mb-1 text-white">Faster way to create web pages</h5>
                            <p class="">That’s my skill. I’m not really specifically talented at
                                anything except for the ability to learn.</p>
                        </div>
                    </div>

                    <!-- slide 3 -->
                    <div slide class="absolute w-full h-full transition-all duration-500">
                        <img class="object-cover h-full" src="{{ asset('') }}assets/img/carousel-3.jpg"
                            alt="carousel image" />
                        <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                            <div
                                class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                <i class="top-0.75 text-xxs relative text-slate-700 ni ni-trophy"></i>
                            </div>
                            <h5 class="mb-1 text-white">Share with us your design tips!</h5>
                            <p class="">Don’t be afraid to be wrong because you can’t learn anything
                                from a compliment.</p>
                        </div>
                    </div>

                    <!-- Control buttons -->
                    <button btn-next
                        class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
                    <button btn-prev
                        class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
                </div>
            </div>
        </div>

        <!-- cards row 3 -->

        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl border-black-125 rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 rounded-t-4">
                        <div class="flex justify-between">
                            <h6 class="mb-2">Sales by Country</h6>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="items-center w-full mb-4 align-top border-collapse border-gray-200">
                            <tbody>
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap">
                                        <div class="flex items-center px-2 py-1">
                                            <div>
                                                <img src="{{ asset('') }}assets/img/icons/flags/US.png"
                                                    alt="Country flag" />
                                            </div>
                                            <div class="ml-6">
                                                <p class="mb-0 text-xs font-semibold leading-tight">
                                                    Country:</p>
                                                <h6 class="mb-0 text-sm leading-normal">United
                                                    States</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Sales:</p>
                                            <h6 class="mb-0 text-sm leading-normal">2500</h6>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Value:</p>
                                            <h6 class="mb-0 text-sm leading-normal">$230,900</h6>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="flex-1 text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Bounce:</p>
                                            <h6 class="mb-0 text-sm leading-normal">29.9%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap">
                                        <div class="flex items-center px-2 py-1">
                                            <div>
                                                <img src="{{ asset('') }}assets/img/icons/flags/DE.png"
                                                    alt="Country flag" />
                                            </div>
                                            <div class="ml-6">
                                                <p class="mb-0 text-xs font-semibold leading-tight">
                                                    Country:</p>
                                                <h6 class="mb-0 text-sm leading-normal">Germany
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Sales:</p>
                                            <h6 class="mb-0 text-sm leading-normal">3.900</h6>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Value:</p>
                                            <h6 class="mb-0 text-sm leading-normal">$440,000</h6>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="flex-1 text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Bounce:</p>
                                            <h6 class="mb-0 text-sm leading-normal">40.22%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap">
                                        <div class="flex items-center px-2 py-1">
                                            <div>
                                                <img src="{{ asset('') }}assets/img/icons/flags/GB.png"
                                                    alt="Country flag" />
                                            </div>
                                            <div class="ml-6">
                                                <p class="mb-0 text-xs font-semibold leading-tight">
                                                    Country:</p>
                                                <h6 class="mb-0 text-sm leading-normal">Great
                                                    Britain</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Sales:</p>
                                            <h6 class="mb-0 text-sm leading-normal">1.400</h6>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Value:</p>
                                            <h6 class="mb-0 text-sm leading-normal">$190,700</h6>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="flex-1 text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Bounce:</p>
                                            <h6 class="mb-0 text-sm leading-normal">23.44%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-0 w-3/10 whitespace-nowrap">
                                        <div class="flex items-center px-2 py-1">
                                            <div>
                                                <img src="{{ asset('') }}assets/img/icons/flags/BR.png"
                                                    alt="Country flag" />
                                            </div>
                                            <div class="ml-6">
                                                <p class="mb-0 text-xs font-semibold leading-tight">
                                                    Country:</p>
                                                <h6 class="mb-0 text-sm leading-normal">Brasil</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-0 whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Sales:</p>
                                            <h6 class="mb-0 text-sm leading-normal">562</h6>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-0 whitespace-nowrap">
                                        <div class="text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Value:</p>
                                            <h6 class="mb-0 text-sm leading-normal">$143,960</h6>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 text-sm leading-normal align-middle bg-transparent border-0 whitespace-nowrap">
                                        <div class="flex-1 text-center">
                                            <p class="mb-0 text-xs font-semibold leading-tight">
                                                Bounce:</p>
                                            <h6 class="mb-0 text-sm leading-normal">32.14%</h6>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-4 pb-0 rounded-t-4">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li
                                class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 rounded-xl">
                                        <i class="text-white ni ni-mobile-button relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700">
                                            Devices</h6>
                                        <span class="text-xs leading-tight">250 in stock, <span class="font-semibold">346+
                                                sold</span></span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all"><i
                                            class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                            aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 rounded-xl">
                                        <i class="text-white ni ni-tag relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700">
                                            Tickets</h6>
                                        <span class="text-xs leading-tight">123 closed, <span class="font-semibold">15
                                                open</span></span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all"><i
                                            class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                            aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-b-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 rounded-xl">
                                        <i class="text-white ni ni-box-2 relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700">
                                            Error logs</h6>
                                        <span class="text-xs leading-tight">1 is active, <span class="font-semibold">40
                                                closed</span></span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all"><i
                                            class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                            aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="relative flex justify-between py-2 pr-4 border-0 rounded-b-lg rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div
                                        class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 rounded-xl">
                                        <i class="text-white ni ni-satisfied relative top-0.75 text-xxs"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700">
                                            Happy users</h6>
                                        <span class="text-xs leading-tight"><span class="font-semibold">+ 430
                                            </span></span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button
                                        class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all"><i
                                            class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                            aria-hidden="true"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cards -->
@endsection
