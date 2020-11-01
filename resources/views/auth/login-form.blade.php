@extends('login')

@section('content')
    <form action="{{ url('login') }}" method="POST">
        @csrf
        <input required type="email" name="email" id="email" placeholder="E-mail">
        <input required type="password" name="password" id="password" placeholder="Mot de passe">
        @isset($response)
            {{ $response['message']  }}
        @endisset
        <input type="submit" value="Valider">
    </form>
@endsection
