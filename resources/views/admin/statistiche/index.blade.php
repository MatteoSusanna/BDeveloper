@extends('layouts.log')

@section('title', 'Area Amministrativa - Statistiche')

@section('content')
<div class="container my-3" style="width: 800px" height="800px">
    <canvas id="myChart" ></canvas>

    <input type="text" id="my_input_review" value="{{count(Auth::user()->review)}}" class="d-none">
    <input type="text" id="my_input_message" value="{{count(Auth::user()->message)}}" class="d-none">
    
</div>
  
<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>

<script>
    myInputReview = document.getElementById('my_input_review').value;
    myInputMessage = document.getElementById('my_input_message').value;

    const labels = [
      'Recensioni',
      'Messaggi',
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'Recensioni & Messaggi',
        backgroundColor: ['#ff8906', '#0f0e17'],
        borderColor: 'rgb(255, 99, 132)',
        data: [myInputReview, myInputMessage, 30],
      }]
    };
  
    const config = {
      type: 'doughnut',
      data: data,
      options: {}
    };
</script>

<script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
</script>
  

    


@endsection