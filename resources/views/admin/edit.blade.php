@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <form action="{{route('admin.profile.update', $developer->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" id="name" name="name" value="{{old('name', $developer->name)}}">
        </div>

        <div class="form-group">
          <label for="lastname">Cognome</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname', $developer->lastname)}}">
        </div>

        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input type="text" class="form-control" id="address" name="address" value="{{old('address', $developer->address)}}">
        </div>

        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
        </div>

        <div class="form-group">
            <label for="hourly_wage">Paga oraria</label>
            <input type="text" class="form-control" id="hourly_wage" name="hourly_wage" value="{{old('hourly_wage')}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
</div>

@endsection