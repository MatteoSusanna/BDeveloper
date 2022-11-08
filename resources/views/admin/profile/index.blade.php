@extends('layouts.app')

@section('title', 'Gestione post')

@section('content')
    <div class="container">
        @foreach (Auth::user()->specialization as $specialization)
            <h1>{{$specialization->name}}</h1>
        @endforeach

        {{-- @foreach (Auth::user()->data as $data)
            <h1>{{$data->phone}}</h1>
        @endforeach --}}

        {{Auth::user()->data}}


    </div>
    
                    
@endsection