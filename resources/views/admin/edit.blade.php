@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <form action="{{route('admin.profile.update', $developer->slug)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{--input cover--}}
        <div>
            @if ($developer->cover)
                <img style="width: 15rem;" src="{{asset('storage/' . $developer->cover)}}">
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
        <div>
            @if ($developer->curriculum)
                <a style="width: 5rem;" href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
                    <img src="{{asset('img/pdf.png')}}" class="img-fluid">
                </a>
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

        {{--input specializzazioni--}}
        <div class="mb-3">
            <label for="specializations" class="form-label">Specializzazioni</label>

            <select name="specializations" id="specializations" class="form-control @error('specializations')is-invalid @enderror" >
                @foreach ($specializations as $specialization)
                    <option specialization {{(old('specializations', $developer->specialization_id)==$specialization->id)?'selected':''}} value="{{$specialization->id}}">{{$specialization->name}}</option>
                @endforeach
            </select>
          
              @error('specializations')
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