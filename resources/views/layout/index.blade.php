<!DOCTYPE html>
<html>
@include('layout.header')

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <div class="absolute bg-y-50 w-full top-0 bg-[url('/assets/img/profile-layout-header.jpg')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
    <div class="absolute w-full bg-blue-950 min-h-96"></div>
    <!-- sidenav  -->
    @include('layout.sidebar')
    <!-- end sidenav -->
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        @yield('content')
        @include('layout.footer')
    </main>
    <!-- Livewire Scripts harus dimuat sebelum penutup body -->
    @livewireScripts

    <!-- script untuk menampilkan pesan kesuksesan -->
    <script>
        Livewire.on('success', (data) => {
            Swal.fire({
                position: "center",
                icon: "success",
                text: data[0].message,
                showConfirmButton: false,
                timer: 2000
            });
        })
    </script>
    <!-- plugin untuk charts -->
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
    <!-- plugin untuk scrollbar -->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <!-- file skrip utama -->
    <script src="{{ asset('assets/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>
</body>

</html>
