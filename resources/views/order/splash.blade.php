<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<body>
    <script>
        const snapToken = @json($snapToken);
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                $.ajax({
                    url: "{{ route('responseMidtrans') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: result,
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('transactionSuccess') }}"
                    },
                    error: function(error) {
                        console.error(error);
                    }
                })
            },
            onPending: function(result) {
                history.go(-2)
                // Swal.fire({
                //     title: "Apa kamu yakin?",
                //     text: "Transaksi akan gagal jika keluar dari halaman ini",
                //     icon: "warning",
                //     showCancelButton: true,
                //     confirmButtonColor: "#3085d6",
                //     cancelButtonColor: "#d33",
                //     confirmButtonText: "Ya, saya yakin!"
                // }).then((res) => {
                //     if (res.isConfirmed) {
                //         $.ajax({
                //             url: "{{ route('responseMidtrans') }}",
                //             type: "POST",
                //             headers: {
                //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                //                     'content')
                //             },
                //             data: result,
                //             dataType: 'json',
                //             success: function(response) {
                //                 window.location.href = "{{ route('transactionFailed') }}"
                //             },
                //             error: function(error) {
                //                 console.error(error);
                //             }
                //         })
                //     }
                // });
            },
            onError: function(result) {
                return console.log(result);
                /* You may add your own implementation here */
                $.ajax({
                    url: "{{ route('responseMidtrans') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: result,
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = "{{ route('transactionFailed') }}"
                    },
                    error: function(error) {
                        window.location.href = "{{ route('transactionFailed') }}"
                    }
                })
            },
            onClose: function() {
                window.location.reload()
            }
        })
        // copy kode donasi
        var trans = document.querySelector('trans')

        function CopyTrans() {
            document.execCommand('copy');
            $("#codeAlert").toast("show")
        }
        trans.addEventListener("copy", function(event) {
            event.preventDefault();
            if (event.clipboardData) {
                event.clipboardData.setData("text/plain", trans.textContent);
            }
        })
    </script>
</body>

</html>
