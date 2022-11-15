@extends('layouts.app')

@section('title', 'Area messaggi')

@section('content')

    <div class="container my-4">
        @if (count($reviews))        
            <table class="my-table">
                <thead class="t-head">
                    <tr>
                        <th class="pl-3" scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Testo</th>
                        <th scope="col">Voto</th>
                    </tr>
                </thead>
                <tbody class="t-body">
                    @foreach ($reviews as $review)
                        <tr>
                            <td class="pl-3">{{$review->name}}</td>
                            <td>{{$review->lastname}}</td>
                            <td>{{$review->text}}</td>
                            <td>{{$review->vote}}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- in caso non ci sono recensioni --}}
            <h2 class="text-center no-message">
                Al momento non ci sono recensioni
            </h2>
        @endif
    </div>

@endsection