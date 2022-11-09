@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <a href="{{route('admin.profile.edit', $developer->id)}}" class="btn btn-warning mb-4">Crea Profilo</a>
 
    <div class="card" style="width: 18rem;">
        {{-- <img src="..." class="card-img-top" alt="..."> --}}
        <div class="card-body">
          <h5 class="card-title">{{$developer->name}}{{$developer->lastname}}</h5>
          <p class="card-text">{{$developer->address}}</p>
          <p class="card-text">{{$developer->email}}</p>
        </div>
    </div> 
</div>

@endsection