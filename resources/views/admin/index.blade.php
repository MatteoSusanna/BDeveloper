@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container my-container p-5 mt-5 mb-5 rounded">

  <div class="d-flex justify-content-around badge data-container m-5">

    <div class="p-5">

      <div class="cover-container mb-4 rounded-circle">
        @if ($developer->cover)
          <img src="{{asset('storage/' . $developer->cover)}}" class="img-fluid">
        @else
          <img src="{{asset('img/user-placeholder.png')}}" class="img-fluid">
        @endif
      </div>
  
      <div class="text-center">
  
        <h1 class="text-capitalize">{{$developer->name}} {{$developer->lastname}}</h1>
  
        @foreach ($specializations as $specialization)
          <h2 class="mt-3">{{ $specialization->name }} Developer</h2>
        @endforeach

        <h4 class="mt-5">COMPETENZE</h4>
        @foreach ($developer->skill as $skill)
          <h5 class="mt-2">{{ $skill->name }}</h5>
        @endforeach
  
      </div>
  
    </div>
  
    <div class="p-5">

      <h4>C.V.</h4>
      <div class="cv-container d-flex flex-wrap align-items-center">
        @if ($developer->curriculum)
          <a href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
            <img src="{{asset('img/pdf.png')}}" class="img-fluid">
          </a>
        @else
        <img src="{{asset('img/no-file.png')}}" class="img-fluid">
        @endif
      </div>
      
      <h4 class="mt-5">EMAIL</h4>
      <h5>{{$developer->email}}</h5>
  
      <div>
  
        <h4>TELEFONO</h4>
        @if ($developer->phone)
          <h5>{{ $developer->phone }}</h5>
        @else
          <h5> - </h5>
        @endif
        
        <h4>INDIRIZZO</h4>
        <h5 class="text-capitalize">{{$developer->address}}</h5>

        <h4>PAGA ORARIA</h4>
        @if ($developer->hourly_wage)
          <h5>€ {{ $developer->hourly_wage }}</h5>
        @else
          <h5> - </h5>
        @endif
  
      </div> 
  
    </div>

  </div>

  <div class="d-flex justify-content-center mt-5 mb-4">

    <a href="{{route('admin.edit')}}" class="btn edit-btn my-btn mr-4" title='Modifica il tuo profilo'><i class="fa-solid fa-user-pen edit-icon my-icon"></i></a>

    <form action="{{route('admin.destroy', $developer->id)}}" method="POST" onsubmit="return confirm('Procedendo cancellerai il tuo profilo, sei sicuro?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger my-btn delete-btn ml-4" title='Elimina il tuo profilo'><i class="fa-solid fa-trash my-icon"></i></button>
    </form>

  </div>
    
</div>

@endsection