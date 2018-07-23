@extends('template')

@section('title', ' - Nouvel Administrateur')
@section('pageName', 'Nouvel Administrateur')

@section('content')

  <a href="{{ url('/') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Créer un nouvel administrateur</h4>
      <p class="card-category">Formulaire</p>
    </div>

    <div class="card-body">
      {!! Form::open(['method' => 'post', 'url' => route('users.store')]) !!}

      <div class="form-group">
        {!! Form::label('name', 'Prénom*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>
      @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </div>
      @endif

      <div class="form-group">
        {!! Form::label('email', 'E-mail*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
      </div>
      @if ($errors->has('email'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </div>
      @endif

      <p class="text-gray mt-4">
        <i class="material-icons">info</i>
        Mot de passe: <strong>000000</strong>
      </p>

    </div>
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-perso">Créer</button>
  </div>
  {!! Form::close() !!}
@endsection
