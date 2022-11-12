@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container my-container p-5 mt-5 mb-5 rounded">

  <div class="d-flex justify-content-around badge data-container m-5">

    <div class="p-5">

      <div class="cover-container mb-4">
        @if ($developer->cover)
          <img src="{{asset('storage/' . $developer->cover)}}" class="img-fluid">
        @else
          <img src="{{asset('img/No-Image-Placeholder.png')}}" class="img-fluid">
        @endif
      </div>
  
      <div class="text-center">
  
        <h1>{{$developer->name}} {{$developer->lastname}}</h1>
  
        @foreach ($specializations as $specialization)
          <h2 class="mt-3">{{ $specialization->name }} Developer</h2>
        @endforeach

        <h4 class="mt-5">COMPETENZE</h4>
        @foreach ($developer->skill as $skill)
          <h6 class="mt-2">{{ $skill->name }}</h6>
        @endforeach
  
      </div>
  
    </div>
  
    <div class="p-5">
  
      <div class="cv-container mb-4">
        <h4>C.V.</h4>
        @if ($developer->curriculum)
          <a href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
            <img src="{{asset('img/pdf.png')}}" class="img-fluid">
          </a>
        @else
          <h6>curriculum non presente</h6>
        @endif
      </div>
      
      <h4>EMAIL</h4>
      <h6>{{$developer->email}}</h6>
  
      <div>
  
        <h4>TELEFONO</h4>
        @if ($developer->phone)
          <h6>{{ $developer->phone }}</h6>
        @else
          <h6> - </h6>
        @endif
        
        <h4>INDIRIZZO</h4>
        <h6>{{$developer->address}}</h6>

        <h4>PAGA ORARIA</h4>
        @if ($developer->hourly_wage)
          <h6>€ {{ $developer->hourly_wage }}</h6>
        @else
          <h6> - </h6>
        @endif
  
      </div> 
  
    </div>

  </div>

  <div class="d-flex justify-content-center mt-5 mb-4">

    <a href="{{route('admin.edit')}}" class="btn edit-btn my-btn mr-4"><i class="fa-solid fa-user-pen edit-icon my-icon"></i></a>

    <form action="{{route('admin.destroy', $developer->id)}}" method="POST" onsubmit="return confirm('Procedendo cancellerai il tuo profilo, sei sicuro?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger my-btn ml-4"><i class="fa-solid fa-trash my-icon"></i></button>
    </form>

  </div>
    
</div>

@endsection