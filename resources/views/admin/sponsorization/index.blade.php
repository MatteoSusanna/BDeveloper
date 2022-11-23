@extends('layouts.app')

@section('title', 'sponsorizzazioni')

@section('content')

@if ($userSponsorizations->last() != '' && $userSponsorizations->last()->ends_at > now())
  <h2 class="text-center mt-5">La tua sponsorizzazione scade il {{$userSponsorizations->last()->ends_at}}</h2>

@endif

<form id="payment-form" action="{{route('admin.sponsorization.store')}}" method="POST">
  @csrf

  <div class="container text-center">
    <div class="payment">
        <div class="input-group">
            <select name="sponsorization_id" id="" class="mt-2 custom-select" required>
                <option value="" selected disabled>Seleziona una sponsorizzazione</option>
                @foreach ($sponsorizations as $sponsorization)
                <option value="{{$sponsorization->id}}" >{{$sponsorization->name}} - {{$sponsorization->price}} € - {{$sponsorization->duration}} H</option>
                @endforeach
            </select>
        </div>
        
        <div id="dropin-wrapper">
            <div id="checkout-message"></div>
            <div id="dropin-container"></div>
            
            <button id="submit-button" @if ($userSponsorizations->last() != '' && $userSponsorizations->last()->ends_at > now()) disabled @endif>Effettua il pagamento</button>
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </div>
    </div>
  </div>
</form>
    <script type="text/javascript">
      const form = document.getElementById('payment-form');
      var button = document.querySelector('#submit-button');
      var client_token = "{{$token}}";
    
      braintree.dropin.create({
        // Insert your tokenization key here
        authorization: client_token,
        container: '#dropin-container'
      }, function (error, dropinInstance) {
        form.addEventListener('submit', event => {
          event.preventDefault();
          let button = document.querySelector('button');
          button.disabled=true;
          dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);
            document.getElementById('nonce').value = payload.nonce;
            $nonceFromTheClient = $_POST["payment_method_nonce"]
      form.submit();
    });
  });
});

    //   braintree.dropin.create({
    //   authorization: client_token,
    //   container: '#dropin-container',
    //   paypal: {
    //         flow: 'vault'
    //     }
    //   }, function (createErr, instance) {
    //   button.addEventListener('click', function () {
    //     instance.requestPaymentMethod(function (err, payload) {
    //       $.get('{{ route('admin.payment.process') }}', {payload}, function (response) {
    //         if (response.success) {
    //           alert('Payment successfull!');
    //         } else {
    //           alert('Payment failed');
    //         }
    //       }, 'json');
    //     });
    //   });
    // });
  </script>


@endsection