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
      <h4 class="card-title ">Ajouter une nouvelle formation</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open([ 'url' => route('formations.store')]) !!}

      <div class="form-group">
        {!! Form::label('name', 'Nom', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('place', 'Lieu', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('place', null, ['class' => 'form-control', 'id' => 'place']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('date_start', 'Date de début', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('date_start', null, ['class' => 'form-control', 'id' => 'date_start']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('date_end', 'Date de fin', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('date_end', null, ['class' => 'form-control', 'id' => 'date_end']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('number_of_vacancies', 'Nombre de participant', ['class' => 'bmd-label-floating']) !!}
        {!! Form::number('number_of_vacancies', null, ['class' => 'form-control', 'id' => 'number_of_vacancies']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('educational_objective', 'Objectifs pédagogiques', ['class' => 'bmd-label-floating']) !!}
        {!! Form::textarea('educational_objective', null, ['class' => 'form-control', 'id' => 'educational_objective']) !!}
      </div>

      <div class="form-check">
        <label class="form-check">
          {!! Form::checkbox('send_email', 1) !!}
          Soumettre à candidatures ?
        </label>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-info">Ajouter</button>
    </div>
    {!! Form::close() !!}
  @endsection