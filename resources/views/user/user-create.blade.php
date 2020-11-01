@extends('welcome')
@extends('main.success-errors')
@section('content')

    <form action="{{ url('/users/store') }}" method="POST" >
        {{ csrf_field() }}
        <div class="text-center">
            <h3> Ajouter un utilisateur </h3>
        </div>
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Nom">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input type="text" name="surname" class="form-control" placeholder="Prénom">
            @if ($errors->has('surname'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="date" name="birthday" class="form-control" placeholder="Date de naissance">
            @if ($errors->has('birthday'))
                <span class="text-danger">{{ $errors->first('birthday') }}</span>
            @endif
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success btn-submit">Valider</button>
        </div>
    </form>
@endsection
