<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body>
    <div class="h-screen w-full">
        <div class="flex flex-col justify-center items-center h-full space-y-5">
            <img src="{{ asset('assets/img/illustrations/Successful-purchase-pana.png') }}" alt="" class="h-72">
            <div class="text-center">
                <p class="text-5xl font-semibold text-slate-800">Terima Kasih</p>
                <p class="text-2xl text-slate-800 mb-5">Pembayaran Berhasil</p>
                <a href="{{route('orderList')}}"
                    class="py-2 px-3 mt-3 text-white font-medium rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500">Cek Pesanan Saya</a>
            </div>
        </div>
    </div>
</body>

</html>
