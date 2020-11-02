@extends('welcome')
@section('content')
    <div class="row text-center">
        <div class="col-12">
            Nom: {{ $user['name']  }}
        </div>
        <div class="col-12">
            Prénom: {{ $user['surname']  }}
        </div>
        <div class="col-12">
            E-mail: {{ $user['email']  }}
        </div>
        <div class="col-12">
            Date de naissance: {{ $user['birthday']  }}
        </div>
    </div>
    <form action="{{ url('/users/delete', ['id' => $user['id']]) }}" method="POST" >
        {{ csrf_field() }}
        <div class="form-group text-center">
            <button class="btn btn-danger btn-submit">Supprimer</button>
        </div>
    </form>
@endsection
