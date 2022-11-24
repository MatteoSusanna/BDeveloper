@extends('layouts.log')

@section('title', 'Area Amministrativa - Statistiche')

@section('content')
<div class="container my-3" style="width: 800px" height="800px">

  <canvas id="myChart" ></canvas>

  <canvas id="myChartMes" ></canvas>

    <input type="text" id="my_input_review" value="{{count(Auth::user()->review)}}" class="d-none">
    <input type="text" id="my_input_message" value="{{count(Auth::user()->message)}}" class="d-none">
    
</div>
  
<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>

<script>
    myInputReview = document.getElementById('my_input_review').value;
    myInputMessage = document.getElementById('my_input_message').value;

    const labels = [
      'Gennaio',
      'Febbraio',
      'Marzo',
      'Aprile',
      'Maggio',
      'Giugno',
      'Luglio',
      'Agosto',
      'Settembre',
      'Ottobre',
      'Novembre',
      'Dicembre',
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'Recensioni',
        backgroundColor: ['#ff8906', '#0f0e17'],
        borderColor: 'rgb(255, 99, 132)',
        data: [0,0,0,0,0,0,0,0,0,0,myInputReview],
      }]
    };

    const dataMes = {
      labels: labels,
      datasets: [{
        label: 'Messaggi',
        backgroundColor: ['#0f0e17', '#ff8906'],
        borderColor: 'rgb(255, 99, 132)',
        data: [0,0,0,0,0,0,0,0,0,0,myInputMessage],
      }]
    };
  
    const config = {
      type: 'bar',
      data: data,
      options: {}
    };
    const configMes = {
      type: 'bar',
      data: dataMes,
      options: {}
    };
</script>

<script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    const myChartMes = new Chart(
      document.getElementById('myChartMes'),
      configMes
    );
</script>
  

    


@endsection