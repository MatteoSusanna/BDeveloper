@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <form action="{{route('admin.profile.update', $developer->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{--input cover--}}
        <div class="card" style="width: 18rem;">
            @if ($developer->cover)
                <img src="{{asset('storage/' . $developer->cover)}}">
            @else
                <h6>immagine non è presente</h6>
            @endif
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Immagine</label>
            <input type="file" id="cover" name="image" class="form-control-file @error('image')is-invalid @enderror">

            @error('image')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        {{--input curriculum--}}
        <div class="card" style="width: 5rem;">
            @if ($developer->curriculum)
                <a href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
                    <img src="{{asset('img/pdf.png')}}" class="img-fluid">
                </a>
            @else
                
                <h6>Curriculum non è presente</h6>
            @endif
        </div>

        <div class="mb-3">
            <label for="curriculum" class="form-label">Curriculum</label>
            <input type="file" id="curriculum" name="curriculum" class="form-control-file @error('curriculum')is-invalid @enderror">

            @error('curriculum')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        {{--input nome--}}
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{old('name', $developer->name)}}">

            @error('name')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        {{--input cognome--}}
        <div class="form-group">
          <label for="lastname">Cognome</label>
          <input type="text" class="form-control @error('lastname')is-invalid @enderror" id="lastname" name="lastname" value="{{old('lastname', $developer->lastname)}}">

          @error('lastname')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        
        {{--input indirizzo--}}
        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input type="text" class="form-control @error('address')is-invalid @enderror" id="address" name="address" value="{{old('address', $developer->address)}}">

            @error('address')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        
        {{--input telefono--}}
        <div class="form-group">
            <label for="phone">Telefono</label>
            <input type="text" class="form-control @error('phone')is-invalid @enderror" id="phone" name="phone" value="{{old('phone', $developer->phone)}}">

            @error('phone')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        
        {{--input paga oraria--}}
        <div class="form-group">
            <label for="hourly_wage">Paga oraria</label>
            <input type="text" class="form-control @error('hourly_wage')is-invalid @enderror" id="hourly_wage" name="hourly_wage" value="{{old('hourly_wage', $developer->hourly_wage)}}">

            @error('hourly_wage')
                  <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
</div>

@endsection