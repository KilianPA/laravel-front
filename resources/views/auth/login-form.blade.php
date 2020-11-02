@extends('welcome')

@section('content')
    <div class="container-login">
        <div class="text-center">
            <h3> Connexion </h3>
        </div>
        @if(Session::get('error'))
            <div class="alert alert-danger">
                    {{ Session::get('error')  }}
            </div>
        @endif
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <input class="form-control mt-2" required type="email" name="email" id="email" placeholder="E-mail">
            <input class="form-control mt-2" required type="password" name="password" id="password" placeholder="Mot de passe">
            @isset($response)
                {{ $response['message']  }}
            @endisset
            <input class="form-control mt-2" type="submit" value="Valider">
        </form>
    </div>
@endsection
