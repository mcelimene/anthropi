@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formations')

@section('content')

  <a href="{{ route('formations.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Ajouter une nouvelle formation</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      <!-- Formulaire -->
      {!! Form::open([ 'url' => route('formations.store')]) !!}

      <!-- Nom de la formation -->
      <div class="form-group">
        {!! Form::label('name', 'Nom*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
      </div>
      @if ($errors->has('name'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </div>
      @endif

      <!-- Lieu de la formation -->
      <div class="form-group">
        {!! Form::label('place', 'Lieu*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('place', null, ['class' => 'form-control', 'id' => 'place']) !!}
      </div>
      @if ($errors->has('place'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('place') }}</strong>
        </div>
      @endif

      <div class="row">
        <div class="col">
          <!-- Date de début de la formation -->
          <div class="form-group">
            {!! Form::label('date_start', 'Date de début*') !!}
            {!! Form::date('date_start', null, ['class' => 'form-control', 'id' => 'date_start']) !!}
          </div>
          @if ($errors->has('date_start'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('date_start') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <!-- Heure de début de la formation -->
          <div class="form-group">
            {!! Form::label('time_start', 'Heure de début*') !!}
            {!! Form::time('time_start', null, ['class' => 'form-control', 'id' => 'time_start']) !!}
          </div>
          @if ($errors->has('time_start'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('time_start') }}</strong>
            </div>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col">
          <!-- Date de fin de la formation -->
          <div class="form-group">
            {!! Form::label('date_end', 'Date de fin*') !!}
            {!! Form::date('date_end', null, ['class' => 'form-control', 'id' => 'date_end']) !!}
          </div>
          @if ($errors->has('date_end'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('date_end') }}</strong>
            </div>
          @endif
        </div>
        <div class="col">
          <!-- Heure de fin de la formation -->
          <div class="form-group">
            {!! Form::label('time_end', 'Heure de fin*') !!}
            {!! Form::time('time_end', null, ['class' => 'form-control', 'id' => 'time_end']) !!}
          </div>
          @if ($errors->has('time_end'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('time_end') }}</strong>
            </div>
          @endif
        </div>
      </div>

      <div class="row">
        @foreach ($levels as $level)
          <div class="col">
            <div class="form-group">
              {!! Form::label('number_of_vacancies', $level->name . 's', ['class' => 'bmd-label-floating']) !!}
              {!! Form::number('number_of_vacancies', 0, ['class' => 'form-control', 'id' => 'number_of_vacancies']) !!}
            </div>
            @if ($errors->has('number_of_vacancies'))
              <div class="alert alert-danger" role="alert">
                <strong>{{ $errors->first('number_of_vacancies') }}</strong>
              </div>
            @endif
          </div>
        @endforeach
      </div>

      <div class="form-group">
        {!! Form::label('educational_objective', 'Objectifs pédagogiques*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::textarea('educational_objective', null, ['class' => 'form-control', 'id' => 'educational_objective']) !!}
      </div>
      @if ($errors->has('educational_objective'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('educational_objective') }}</strong>
        </div>
      @endif

      <div class="form-check">
        <label class="form-check">
          {!! Form::checkbox('send_email', 1) !!}
          Soumettre à candidatures ?
        </label>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-perso">Ajouter</button>
    </div>
    {!! Form::close() !!}
  @endsection
