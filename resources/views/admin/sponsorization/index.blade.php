@extends('layouts.app')

@section('title', 'sponsorizzazioni')

@section('content')

@if ($userSponsorizations->last() != '' && $userSponsorizations->last()->ends_at > now())
  <h2 class="text-center mt-5">La tua sponsorizzazione scade il {{$userSponsorizations->last()->ends_at}}</h2>

@endif

<form action="{{route('admin.sponsorization.store')}}" method="POST">
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
        </div>
    </div>
  </div>
    <script type="application/javascript">
      var button = document.querySelector('#submit-button');
    
      braintree.dropin.create({
        // Insert your tokenization key here
        authorization: 'sandbox_d5rfmhp7_6ypmc473hntyvpvy',
        container: '#dropin-container'
      }, function (createErr, instance) {
        button.addEventListener('click', function () {
          instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            // When the user clicks on the 'Submit payment' button this code will send the
            // encrypted payment information in a variable called a payment method nonce
            $.ajax({
              type: 'POST',
              url: '/checkout',
              data: {'paymentMethodNonce': payload.nonce}
            }).done(function(result) {
              // Tear down the Drop-in UI
              instance.teardown(function (teardownErr) {
                if (teardownErr) {
                  console.error('Could not tear down Drop-in UI!');
                } else {
                  console.info('Drop-in UI has been torn down!');
                  // Remove the 'Submit payment' button
                  $('#submit-button').remove();
                }
              });
    
              if (result.success) {
                $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
              } else {
                console.log(result);
                $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
              }
            });
          });
        });
      });
  </script>
</form>

@endsection