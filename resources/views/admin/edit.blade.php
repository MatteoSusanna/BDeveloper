@extends('layouts.app')

@section('title', 'Area Amministrativa')

@section('content')

<div class="container my-5 edit">
    <h1 class="text-center mb-5">Modifica Profilo</h1>
    <form action="{{route('admin.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-around mb-5">

            <div>

                {{--input cover--}}
                <div class="mb-5">
    
                    <div class=" cover-container rounded-circle">
                        @if ($developer->cover)
                            <img class="img-fluid" src="{{asset('storage/' . $developer->cover)}}">
                        @else
                            <img src="{{asset('img/user-placeholder.png')}}" class="img-fluid">
                        @endif
                    </div>
        
                    <div class="mt-3">
                        <label for="cover" class="form-label">Immagine</label>
                        <input type="file" id="cover" name="image" class="form-control-file @error('image')is-invalid @enderror" accept="image/*">
        
                        @error('image')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
    
                </div>
    
                {{--input curriculum--}}
                <div>
    
                    <div class="cv-container">
                        @if ($developer->curriculum)
                            <a href="{{asset('storage/' . $developer->curriculum)}}" target="_blank">
                                <img src="{{asset('img/pdf.png')}}" class="img-fluid">
                            </a>
                        @else
                            <img src="{{asset('img/No-file.png')}}" class="img-fluid">
                        @endif
                    </div>
        
                    <div class="mt-3">
                        <label for="curriculum" class="form-label">Curriculum</label>
                        <input type="file" id="curriculum" name="curriculum" class="form-control-file @error('curriculum')is-invalid @enderror" accept="application/pdf">
        
                        @error('curriculum')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
    
                </div>
    
            </div>
    
            <div class="d-flex flex-column align-items-center my-4">
    
                {{--input nome--}}
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control input @error('name')is-invalid @enderror" id="name" name="name" value="{{old('name', $developer->name)}}" required>
        
                    @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
        
                {{--input cognome--}}
                <div class="form-group">
                    <label for="lastname">Cognome</label>
                    <input type="text" class="form-control input @error('lastname')is-invalid @enderror" id="lastname" name="lastname" value="{{old('lastname', $developer->lastname)}}" required>
        
                    @error('lastname')
                            <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                
                {{--input indirizzo--}}
                <div class="form-group">
                    <label for="address">Indirizzo</label>
                    <input type="text" class="form-control input @error('address')is-invalid @enderror" id="address" name="address" value="{{old('address', $developer->address)}}" required>
    
                    @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
    
                {{--input telefono--}}
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" class="form-control input @error('phone')is-invalid @enderror" id="phone" name="phone" value="{{old('phone', $developer->phone)}}">
    
                    @error('phone')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                
                {{--input paga oraria--}}
                <div class="form-group">
                    <label for="hourly_wage">Paga oraria</label>
                    <input type="text" class="form-control input @error('hourly_wage')is-invalid @enderror" id="hourly_wage" name="hourly_wage" value="{{old('hourly_wage', $developer->hourly_wage)}}">
    
                    @error('hourly_wage')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
    
            </div>

        </div>

        <div class="d-flex justify-content-around mb-4">

            <div class="check-container text-center">
                <h4 class="ml-1">Specializzazioni</h4>
                <div class="d-flex flex-wrap justify-content-center">
                    {{--input specializzazioni--}}
                    @foreach ($specializations as $specialization)
                        @if ($errors->any())
                            <div class="check-group cat">
                                <label for="specialization_{{$specialization->id}}">
                                    <input {{(in_array($specialization->id, old('specializations', [])))? 'checked': ''}} type="checkbox" id="specialization_{{$specialization->id}}" name="specializations[]" value="{{$specialization->id}}">
                                    <span>{{$specialization->name}}</span>
                                </label>
                            </div>
                        @else
                            <div class="check-group cat">
                                <label for="specialization_{{$specialization->id}}">
                                    <input {{($developer->specialization->contains($specialization))? 'checked': ''}} type="checkbox" id="specialization_{{$specialization->id}}" name="specializations[]" value="{{$specialization->id}}">
                                    <span>{{$specialization->name}}</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
    
                    @error('specializations')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
    
            <div class="check-container text-center">
    
                {{--input competenze--}}
                <h4 class="ml-1">Competenze</h4>
                <div class="d-flex flex-wrap justify-content-center">
                    @foreach ($skills as $skill)
                        @if ($errors->any())
                            <div class="form-group cat">
                                <label class="form-check-label" for="skill_{{$skill->id}}">
                                    <input {{(in_array($skill->id, old('skills', [])))? 'checked': ''}} type="checkbox" id="skill_{{$skill->id}}" name="skills[]" value="{{$skill->id}}">
                                    <span>{{$skill->name}}</span>
                                </label>
                            </div>
                        @else
                            <div class="form-group cat">
                                <label class="form-check-label" for="skill_{{$skill->id}}">
                                    <input {{($developer->skill->contains($skill))? 'checked': ''}} type="checkbox" id="skill_{{$skill->id}}" name="skills[]" value="{{$skill->id}}">
                                    <span>{{$skill->name}}</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
    
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
    
            </div>

        </div>

        <div class="d-flex justify-content-center">

            <button type="submit" class="btn my-btn mt-4">Salva modifiche</button>

        </div>

    </form>
    
</div>

@endsection