@extends('template')

@section('title', '- Suivi des formations')
@section('pageName', 'Suivi des formations')

@section('content')
  <div class="row">
    @foreach($formations as $formation)
      <div class="col-md-4">
        <div class="card">
          <div class="card-header card-header-perso">
            <h4 class="card-title ">Formation non validée</h4>
            <p class="card-category">
              Début dans <strong>{{ \Carbon\Carbon::parse($formation->date_start)->diffInDays($today) }}
              @if(\Carbon\Carbon::parse($formation->date_start)->diffInDays($today) == '1')
                jour
              @else
                jours
              @endif
              </strong>
            </p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              @if($formation->number_of_assistant_trainers)
                <h6 class="text-gray">Assistant-formateur 0/6</h6>

              <h6 class="card-category text-gray">Formateur</h6>
              <h6 class="card-category text-gray">Autre</h6>
            </div>
            <button type="button" class="btn btn-success">Valider</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
