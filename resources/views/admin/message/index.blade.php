@extends('layouts.app')

@section('title', 'Area messaggi')

@section('content')

    <div class="container my-4">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Testo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{$message->name}}</td>
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
    </div>

@endsection