@extends('template')

@section('title', ' - Fichier avec données des formateurs')
@section('pageName', 'Fichier avec données des formateurs')

@section('content')

  <a href="{{ route('datadock.index') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Données des formateurs</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open(['method' => 'POST', 'url' => route('datadock.dataTrainersStore')]) !!}

      <div class="form-group">
        {!! Form::label('column', 'Éléments à transmettre*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('column',
          [
            'address' => 'Adresse',
            'phone_number' => 'Numéro de téléphone',
            'social_security' => 'Numéro de sécurité sociale',
            'birthdate' => 'Date de naissance',
            'region_id' => 'Région',
            'senority' => "Date d'ancienneté",
            'job' => 'Profession',
            'speciality' => 'Spécialité',
            'level_id' => 'Niveau'
          ], null, [
            'class' => 'form-control',
            'id' => 'column',
            'multiple' => true,
            'name' => 'column[]',
            'style' => 'height: 100px;']) !!}
          </div>
          @if ($errors->has('column'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ $errors->first('column') }}</strong>
            </div>
          @endif

          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="choiceTrainers" id="choiceTrainers1" value="all" checked>
              Tous les formateurs
              <span class="circle">
                <span class="check"></span>
              </span>
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="choiceTrainers" id="choiceTrainers2" value="choice">
              Sélectionner les formateurs
              <span class="circle">
                <span class="check"></span>
              </span>
            </label>
          </div>

          <div class="form-group form-hidden" id="form-trainers">
            {!! Form::label('trainers', 'Formateurs à sélectionner*', ['class' => 'bmd-label-floating']) !!}
            {!! Form::select('trainers', $trainers, null, [
              'class' => 'form-control',
              'id' => 'trainers',
              'multiple' => true,
              'name' => 'trainers[]',
              'style' => 'height: 100px;']) !!}
            </div>
            @if ($errors->has('trainers'))
              <div class="alert alert-danger" role="alert">
                <strong>{{ $errors->first('trainers') }}</strong>
              </div>
            @endif

            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-perso">Générer</button>
            </div>

          {!! Form::close() !!}
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#choiceTrainers2').click(function(){
      $('#form-trainers').removeClass('form-hidden');
    });
    $('#choiceTrainers1').click(function(){
      $('#form-trainers').addClass('form-hidden');
    });
  </script>
@endsection
