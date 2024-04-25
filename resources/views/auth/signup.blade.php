<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/logos/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/logos/favicon-32x32.png')}}" />
    <title>Sign up | Wedding Organizer</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <section class="min-h-screen">
            <div class="relative h-screen overflow-hidden">
                <div class="absolute inset-0 bg-[url('/assets/img/bg-3.png')] bg-cover bg-center blur-sm w-full"></div>
                <div class="relative flex items-center h-full">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12">
                        <div
                            class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                            <div id="head" class="flex flex-col justify-center items-center mt-4">
                                <h1 class="mt-5 mb-2 text-slate-900 font-semibold text-lg lg:text-3xl">Buat akun baru
                                </h1>
                                <p class="mt-4 mb-0 leading-normal text-sm lg:text-base">Sudah memiliki akun? <a
                                        href="{{ route('login') }}" class="font-bold text-blue-900">Masuk</a></p>
                            </div>
                            {{-- Form signup customer --}}
                            <div id="formCustomer" class="flex-auto p-6">
                                <form method="POST" action="{{ route('signupCustomer') }}" role="form text-left">
                                    @csrf
                                    @method('POST')
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="mb-4">
                                            <input type="text"
                                                class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                                placeholder="Nama lengkap" name="fullname" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="number"
                                                class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                                placeholder="Nomor HP" name="phone" />
                                        </div>
                                    </div>
                                    <div class="border-t  border-slate-400">
                                        <div class="my-4">
                                            <input type="text"
                                                class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                                placeholder="Username" name="username" />
                                        </div>
                                        <div class="mb-4">
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
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" id="btn-submit"
                                            class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-800 to-cyan-700 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('assets/js/passwordMeter.js') }}" async></script>
    <script src="{{ asset('assets/js/showPassword.js') }}" async></script>
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>
