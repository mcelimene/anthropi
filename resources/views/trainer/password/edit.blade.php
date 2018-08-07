@extends('template')

@section('title', ' - Mot de passe')
@section('pageName', 'Mot de passe')

@section('content')

  <div class="card">
    <div class="card-header card-header-perso">
      <div>
        <h4 class="card-title ">Modifier mon mot de passe</h4>
        <p class="card-category">Formulaire</p>
      </div>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'put', 'url' => route('password-change.update', $user)]) !!}

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
