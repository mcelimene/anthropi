@extends('template')

@section('title', ' - Gestion des formateurs')
@section('pageName', 'Gestion des formateurs')

@section('content')
  @if($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <a href="{{ route('trainers.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
       Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title ">Modifier le formateur : {{ $trainer->first_name }} {{ $trainer->last_name }}</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'put', 'url' => route('trainers.update', $trainer)]) !!}

      <div class="form-group">
        {!! Form::label('first_name', 'Prénom', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('first_name', $trainer->first_name, ['class' => 'form-control', 'id' => 'first_name']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('last_name', 'Nom', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('last_name', $trainer->last_name, ['class' => 'form-control', 'id' => 'last_name']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('email', 'E-mail', ['class' => 'bmd-label-floating']) !!}
        {!! Form::email('email', $trainer->email, ['class' => 'form-control', 'id' => 'email']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('region_id', 'Région', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('region_id', $regions, $trainer->region_id, ['class' => 'form-control', 'id' => 'region_id']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('rank', 'Grade', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('rank', $trainer->rank, ['class' => 'form-control', 'id' => 'rank']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('speciality', 'Spécialité', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('speciality', $trainer->speciality, ['class' => 'form-control', 'id' => 'speciality']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('level_id', 'Niveau', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('level_id', $levels, $trainer->level_id, ['class' => 'form-control', 'id' => 'level_id']) !!}
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">Modifier</button>
  </div>
  {!! Form::close() !!}
@endsection
