@extends('template')

@section('title', ' - Ajout fichier Datadock')
@section('pageName', 'Ajout fichier Datadock')

@section('content')

  <a href="{{ route('datadock.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Ajouter un nouveau fichier</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open([ 'url' => route('datadock.store'), 'files' => 'true']) !!}
        <!-- Nom du fichier -->
        <div class="form-group">
          {!! Form::label('name', 'Nom du fichier*', ['class' => 'bmd-label-floating']) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
        @if ($errors->has('name'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
          </div>
        @endif
        <!-- Fichier -->
        <div class="mt-5">
          {!! Form::label('file', 'Fichier') !!}
          {!! Form::file('file') !!}
        </div>
        @if ($errors->has('file'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
          </div>
        @endif
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-perso">Ajouter</button>
    </div>

    {!! Form::close() !!}
  @endsection
