@extends('layouts.app')

@section('title', 'Area messaggi')

@section('content')

    <div class="container my-4">
        @if (count($reviews))        
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Testo</th>
                        <th scope="col">Voto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{$review->name}}</td>
                            <td>{{$review->lastname}}</td>
                            <td>{{$review->text}}</td>
                            <td>{{$review->vote}}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- in caso non ci sono recensioni --}}
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Al momento non ci sono recensioni!!</th>
                    </tr>
                </thead>
            </table>
        @endif
    </div>

@endsection