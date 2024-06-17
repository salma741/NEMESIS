@extends('landing-pages-layouts.main')
@section('container')
@include('sweetalert::alert')
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{config('midtrans.client_key')}}"></script>

<button class="btn btn-primary submit-btn" id="pay-button">Bayar Sekarang</button>

<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Sukses!");
    const url = '<?=  URL::to('registration-member'); ?>';
        window.open(url,  '_self');        
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("Sedang menunggu pembayaran anda!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Gagal!"); console.log(result);
      },
onClose: function(){
        /* You may add your own implementation here */
        alert('Anda menutup pop up tanpa melakukan pembayaran');
      }
    })
  });
</script>

@endsection
