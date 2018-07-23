@extends('template')

@section('title', ' - Mon profil')
@section('pageName', 'Mon profil')

@section('content')

  <a href="{{ url('/') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso d-flex justify-content-between">
      <div>
        <h4 class="card-title ">Modifier mon profil</h4>
        <p class="card-category">Formulaire</p>
      </div>
      <div>
        {!! Form::open(['method' => 'DELETE', 'route' => ['profils.destroy', $user->id]]) !!}
          <button type="submit" rel="tooltip" class="btn btn-danger btn-simple">Supprimer mon compte</button>
        {!! Form::close() !!}
      </div>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'put', 'url' => route('profils.update', $user)]) !!}

      <div class="form-group">
        {!! Form::label('name', 'Prénom*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>
      @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </div>
      @endif

      <div class="form-group">
        {!! Form::label('email', 'E-mail*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email']) !!}
      </div>
      @if ($errors->has('email'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </div>
      @endif

      <div class="form-group">
        {!! Form::label('password', 'Nouveau mot de passe', ['class' => 'bmd-label-floating']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
      </div>
      @if ($errors->has('password'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </div>
      @endif

    </div>
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-perso">Modifier</button>
  </div>
  {!! Form::close() !!}
@endsection
