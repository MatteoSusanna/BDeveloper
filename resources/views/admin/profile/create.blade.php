@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container">
    <div class="container">
        <form action="{{route('admin.profile.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
              <label for="phone" class="form-label">phone</label>
              <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="phone" value="{{old('phone')}}">
            
                @error('phone')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
    
        
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
    

    
</div>

@endsection