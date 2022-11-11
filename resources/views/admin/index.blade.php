@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">

  <div class="d-flex align-items-center">

    <div class="cover-container">
      @if ($developer->cover)
        <img src="{{asset('storage/' . $developer->cover)}}" class="card-img-top">
      @else
      <img src="{{asset('img/No-Image-Placeholder.png')}}" class="img-fluid">
      @endif
    </div>

    <div  class="ml-5">

      <h1>{{$developer->name}} {{$developer->lastname}}</h1>

      @foreach ($specializations as $specialization)
        <h2>{{ $specialization->name }}</h2>
      @endforeach

    </div>

  </div>

    <div class="cv-container">
      <h3>C.V.</h3>
      @if ($developer->curriculum)
        <a style="width: 5rem;" href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
          <img src="{{asset('img/pdf.png')}}" class="img-fluid">
        </a>
      @else
        <h6>curriculum non presente</h6>
      @endif
    </div>
    
    <h3>EMAIL</h3>
    <h5>{{$developer->email}}</h5>

    <div>
      <h3>COMPETENZE</h3>
      @foreach ($developer->skill as $skill)
        <h5>{{ $skill->name }}</h5>
      @endforeach

      <h3>TELEFONO</h3>
      @if ($developer->phone)
        <h5>{{ $developer->phone }}</h5>
      @endif

      <h3>PAGA ORARIA</h3>
      @if ($developer->hourly_wage)
        <h5>€ {{ $developer->hourly_wage }}</h5>
      @endif
      
      <h3>INDIRIZZO</h3>
      <h5>{{$developer->address}}</h5>

    </div> 

    <div class="d-flex mt-3">

      <a href="{{route('admin.edit')}}" class="btn btn-warning mb-4 mr-3"><i class="fa-solid fa-user-pen"></i></a>

      <form action="{{route('admin.destroy', $developer->id)}}" method="POST" onsubmit="return confirm('Procedendo cancellerai il tuo profilo, sei sicuro?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-4"><i class="fa-solid fa-trash"></i></button>
      </form>

    </div>
</div>

@endsection