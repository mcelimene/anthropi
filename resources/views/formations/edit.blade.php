@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formations')

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

  <a href="{{ route('formations.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title ">Modfier la formation : {{ $formation->name }}</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'PUT', 'url' => route('formations.update', $formation)]) !!}

      <div class="form-group">
        {!! Form::label('name', 'Nom', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', $formation->name, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('place', 'Lieu', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('place', $formation->place, ['class' => 'form-control', 'id' => 'place']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('date_start', 'Date de début', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('date_start', $formation->date_start, ['class' => 'form-control', 'id' => 'date_start']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('date_end', 'Date de fin', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('date_end', $formation->date_end, ['class' => 'form-control', 'id' => 'date_end']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('number_of_vacancies', 'Nombre de participant', ['class' => 'bmd-label-floating']) !!}
        {!! Form::number('number_of_vacancies', $formation->number_of_vacancies, ['class' => 'form-control', 'id' => 'number_of_vacancies']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('educational_objective', 'Objectifs pédagogiques', ['class' => 'bmd-label-floating']) !!}
        {!! Form::textarea('educational_objective', $formation->educational_objective, ['class' => 'form-control', 'id' => 'educational_objective']) !!}
      </div>

      @if($formation->send_email == false)
        <div class="form-check">
          <label class="form-check">
            {!! Form::checkbox('send_email', 1) !!}
            Soumettre à candidatures ?
          </label>
        </div>
      @endif
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-info">Modifier</button>
    </div>
    {!! Form::close() !!}
  @endsection
