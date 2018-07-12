@extends('template')

@section('title', ' - Gestion des formateurs')
@section('pageName', 'Gestion des formateurs')

@section('content')

  <a href="{{ route('trainers.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Ajouter un nouveau formateur</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open([ 'url' => route('trainers.store')]) !!}

      <div class="row">
        <div class="col">
          <div class="form-group">
            {!! Form::label('first_name', 'Prénom*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name']) !!}
          </div>
          @if ($errors->has('first_name'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('first_name') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <div class="form-group">
            {!! Form::label('last_name', 'Nom*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name']) !!}
          </div>
          @if ($errors->has('last_name'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('last_name') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <div class="form-group">
            {!! Form::label('email', 'E-mail*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
          </div>
          @if ($errors->has('email'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('region_id', 'Région*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('region_id', $regions, null, ['class' => 'form-control', 'id' => 'region_id', 'placeholder' => 'Sélectionnez une région']) !!}
      </div>
      @if ($errors->has('region_id'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('region_id') }}</strong>
        </div>
      @endif
      <div class="row">
        <div class="col">
          <div class="form-group">
            {!! Form::label('rank', 'Grade*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('rank', null, ['class' => 'form-control', 'id' => 'rank']) !!}
          </div>
          @if ($errors->has('rank'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('rank') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <div class="form-group">
            {!! Form::label('speciality', 'Spécialité*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('speciality', null, ['class' => 'form-control', 'id' => 'speciality']) !!}
          </div>
          @if ($errors->has('speciality'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('speciality') }}</strong>
            </div>
          @endif
        </div>
      </div>

      <div class="form-group">
        {!! Form::label('level_id', 'Niveau*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('level_id', $levels, null, [
          'class' => 'form-control',
          'id' => 'level_id',
          'placeholder' => 'Sélectionnez un niveau']) !!}
        </div>
        @if ($errors->has('level_id'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('level_id') }}</strong>
          </div>
        @endif

      </div>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-perso">Ajouter</button>
    </div>

    {!! Form::close() !!}
  @endsection
