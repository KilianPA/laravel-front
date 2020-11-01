@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }} <a href="{{ url('/') }}">Retour à l'accueil</a>
        @php
            Session::forget('success');
        @endphp
    </div>
@endif
@if(Session::get('serverErrors'))
    <div class="alert alert-success">
        @foreach(Session::get('serverErrors') as $errors)
            {{ $errors['message']  }}
        @endforeach
    </div>
@endif
