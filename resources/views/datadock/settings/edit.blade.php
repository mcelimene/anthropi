@extends('template')

@section('title', ' - Paramètres')
@section('pageName', 'Paramètres')

@section('content')
  <a href="{{ url('/home-datadock') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <div>
        <h4 class="card-title ">Modifier votre profil</h4>
        <p class="card-category">Formulaire</p>
      </div>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'put', 'url' => route('settings.update')]) !!}

      <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'bmd-label-floating']) !!}
        {!! Form::email('email', $datadock->email, ['class' => 'form-control', 'id' => 'email']) !!}
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
