@extends('template')

@section('title', ' - Nouveau Niveau')
@section('pageName', 'Nouveau Niveau')

@section('content')

  <a href="{{ url('/') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Créer un nouveau niveau</h4>
      <p class="card-category">Formulaire</p>
    </div>

    <div class="card-body">
      {!! Form::open(['method' => 'post', 'url' => route('levels.store')]) !!}

      <div class="form-group">
        {!! Form::label('name', 'Nom*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>
      @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </div>
      @endif

    </div>
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-perso">Créer</button>
  </div>
  {!! Form::close() !!}
@endsection
