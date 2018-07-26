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
      <h4 class="card-title ">Modifier le formateur : {{ $trainer->first_name }} {{ $trainer->last_name }}</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'PUT', 'url' => route('trainers.update', $trainer), 'files' => true]) !!}

      <div class="row">
        <div class="col">
          <!-- Prénom -->
          <div class="form-group">
            {!! Form::label('first_name', 'Prénom*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('first_name', $trainer->first_name, ['class' => 'form-control', 'id' => 'first_name']) !!}
          </div>
          @if ($errors->has('first_name'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('first_name') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <!-- Nom de famille -->
          <div class="form-group">
            {!! Form::label('last_name', 'Nom*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('last_name', $trainer->last_name, ['class' => 'form-control', 'id' => 'last_name']) !!}
          </div>
          @if ($errors->has('last_name'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('last_name') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <!-- Email -->
          <div class="form-group">
            {!! Form::label('email', 'E-mail*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::email('email', $trainer->user->email, ['class' => 'form-control', 'id' => 'email']) !!}
          </div>
          @if ($errors->has('email'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <!-- Adresse -->
      <div class="form-group">
        {!! Form::label('address', 'Adresse*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('address', $trainer->address, ['class' => 'form-control', 'id' => 'address']) !!}
      </div>
      @if ($errors->has('address'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('address') }}</strong>
        </div>
      @endif

      <div class="row">
        <div class="col">
          <!-- Téléphone -->
          <div class="form-group">
            {!! Form::label('phone_number', 'Téléphone', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('phone_number', $trainer->phone_number, ['class' => 'form-control', 'id' => 'phone_number']) !!}
          </div>
        </div>
        <div class="col">
          <!-- Sécu -->
          <div class="form-group">
            {!! Form::label('social_security', 'Numéro de sécurité sociale', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('social_security', $trainer->social_security, ['class' => 'form-control', 'id' => 'social_security']) !!}
          </div>
        </div>
        <div class="col">
          <!-- Date de naissance -->
          <div class="form-group">
            {!! Form::label('birthdate', 'Date de naissance*') !!}
            {!! Form::date('birthdate', $trainer->birthdate, ['class' => 'form-control', 'id' => 'birthdate']) !!}
          </div>
          @if ($errors->has('birthdate'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('birthdate') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <!-- Region -->
      <div class="form-group">
        {!! Form::label('region_id', 'Région*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('region_id', $regions, $trainer->region_id, ['class' => 'form-control', 'id' => 'region_id', 'placeholder' => 'Sélectionnez une région']) !!}
      </div>
      @if ($errors->has('region_id'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('region_id') }}</strong>
        </div>
      @endif
      <div class="row">
        <div class="col">
          <!-- Profession -->
          <div class="form-group">
            {!! Form::label('job', 'Profession*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('job', $trainer->job, ['class' => 'form-control', 'id' => 'job']) !!}
          </div>
          @if ($errors->has('job'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('job') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <!-- Spécialité -->
          <div class="form-group">
            {!! Form::label('speciality', 'Spécialité*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::text('speciality', $trainer->speciality, ['class' => 'form-control', 'id' => 'speciality']) !!}
          </div>
          @if ($errors->has('speciality'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('speciality') }}</strong>
            </div>
          @endif
        </div>
      </div>
      <!-- Niveau -->
      <div class="form-group">
        {!! Form::label('level_id', 'Niveau*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('level_id', $levels, $trainer->level_id, [
          'class' => 'form-control',
          'id' => 'level_id',
          'placeholder' => 'Sélectionnez un niveau']) !!}
        </div>
        @if ($errors->has('level_id'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('level_id') }}</strong>
          </div>
        @endif
        <!-- Ancienneté -->
        <div class="form-group">
          {!! Form::label('senority', 'Ancienneté') !!}
          {!! Form::date('senority', $trainer->senority, ['class' => 'form-control', 'id' => 'senority']) !!}
        </div>
        <!-- CV -->
        <div class="mt-3">
          {!! Form::label('cv', 'CV') !!}
          {!! Form::file('cv') !!}
        </div>
      </div>
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-perso">Modifier</button>
  </div>
  {!! Form::close() !!}
@endsection
