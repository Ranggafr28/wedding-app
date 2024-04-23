<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body>
    <div class="h-screen w-full">
        <div class="flex flex-col justify-center items-center h-full space-y-5">
            <img src="{{ asset('assets/img/illustrations/4983482.jpg') }}" alt="" class="h-72">
            <div class="text-center">
                <p class="text-5xl font-semibold text-slate-800">Mohon Maaf</p>
                <p class="text-2xl text-slate-800 mb-5">Pembayaran Anda Belum Berhasil</p>
                <a href="{{ route('dashboard') }}"
                    class="py-2 px-3 mt-3 text-white font-medium rounded-lg bg-gradient-to-r from-yellow-500 to-amber-500">Kembali
                    ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>
