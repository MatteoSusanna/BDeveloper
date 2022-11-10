@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <a href="{{route('admin.edit', $developer->slug)}}" class="btn btn-warning mb-4">Modifica Profilo</a>

    <form action="{{route('admin.destroy', $developer->id)}}" method="POST" onsubmit="return confirm('Procedendo cancellerai il tuo profilo, sei sicuro?');">
      @csrf
      @method('DELETE')


      <button type="submit" class="btn btn-danger mb-4">Elimina account</button>
    </form>
 
    <div class="card" style="width: 18rem;">
        @if ($developer->cover)
          <img src="{{asset('storage/' . $developer->cover)}}" class="card-img-top">
        @else
            <h6>immagine non è presente</h6>
        @endif

        <div class="card-body">
          <h5 class="card-title">{{$developer->name}}{{$developer->lastname}}</h5>
          <p class="card-text">{{$developer->address}}</p>
          <p class="card-text">{{$developer->email}}</p>
        </div>
    </div> 
</div>

@endsection