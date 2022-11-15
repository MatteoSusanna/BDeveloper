@extends('layouts.app')

@section('title', 'Area messaggi')

@section('content')

    <div class="container messages-container">
        @if (count($messages))        
            <table class="my-table rounded">
                <thead >
                    <tr class="t-head">
                        <th class="pl-3" scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Testo</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody class="t-body">
                    @foreach ($messages as $message)
                        <tr>
                            <td class="pl-3">{{$message->name}}</td>
                            <td>{{$message->lastname}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->text}}</td>

                            <td>                            
                                <form action="{{route('admin.message.delete', ['message' => $message->id])}}" method="POST" onsubmit="return confirm('Vuole eliminare questo messaggio definitivamente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn fas fa-trash-alt text-danger"></button>
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- in caso non ci sono messaggi --}}
            <h2 class="text-center no-message">
                Al momento non ci sono messaggi
            </h2>
        @endif
    </div>

@endsection