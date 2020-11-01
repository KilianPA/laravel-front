@extends('welcome')
@extends('main.success-errors')
@section('content')
    <form action="{{ url('/users/update', ['id' => $user['id']]) }}" method="POST">
        {{ csrf_field() }}
        <div class="text-center">
            <h3> Modifier un utilisateur </h3>
        </div>
        <div class="form-group">
            <input type="text" name="name" value="{{ $user['name']  }}" class="form-control" placeholder="Nom">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <input type="text" name="surname" value="{{ $user['surname']  }}" class="form-control" placeholder="Prénom">
            @if ($errors->has('surname'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="text" name="email" value="{{ $user['email']  }}" class="form-control" placeholder="Email">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <input type="date" name="birthday" value="{{ \Carbon\Carbon::parse($user['birthday'])->format('yy-m-d')  }}" class="form-control" placeholder="Date de naissance">
            @if ($errors->has('birthday'))
                <span class="text-danger">{{ $errors->first('birthday') }}</span>
            @endif
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success btn-submit">Modifier</button>
        </div>
    </form>
@endsection
