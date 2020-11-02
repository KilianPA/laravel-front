@extends('welcome')

@section('content')
    <div class="row p-2">
        <div class="col-6">
            <h3> Liste des utilisateurs </h3>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" type="button" onclick="window.location='{{ url('users/store') }}'">Ajouter un utilisateur</button>
        </div>
    </div>
    <div class="row border-top p-3">
        <div class="col-2 text-black-50">
            Nom
        </div>
        <div class="col-2 text-black-50">
            Prénom
        </div>
        <div class="col-2 text-black-50">
            E-mail
        </div>
        <div class="col-2 text-black-50">
            Date de naissance
        </div>
    </div>
    @forelse ($data['data'] as $user)
        <div class="row border-top p-3">
            <div class="col-2">
                {{ $user['name']  }}
            </div>
            <div class="col-2">
                {{ $user['surname']  }}
            </div>
            <div class="col-2">
                {{ $user['email']  }}
            </div>
            <div class="col-2">
                {{ $user['birthday']  }}
            </div>
            <div class="col-2">
                <button class="btn btn-secondary" type="button" onclick="window.location='{{ url('users/update/' . $user['id']) }}'">Editer</button>
            </div>
            <div class="col-2">
                <button class="btn btn-danger" type="button" onclick="window.location='{{ url('users/delete/' . $user['id']) }}'">Supprimer</button>
            </div>
        </div>
    @empty
    @endforelse
@endsection
