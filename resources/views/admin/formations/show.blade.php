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
      <h4 class="card-title ">Fiche Formation</h4>
    </div>
    <div class="card-body">
      <ul>
        <li>
          <strong>Nom</strong> : {{ $formation->name }}
        </li>
        <li>
          <strong>Lieu</strong> : {{ $formation->place }}
        </li>
        <li>
          <strong>Dates</strong> : Du {{ \Carbon\Carbon::parse($formation->date_start)->format('d/m/Y')}} à {{ \Carbon\Carbon::parse($formation->time_start)->format('h:i')}}h au {{ \Carbon\Carbon::parse($formation->date_end)->format('d/m/Y')}} à {{ \Carbon\Carbon::parse($formation->time_end)->format('h:i') }}h
        </li>
        <li>
          <strong>Nombre de participants</strong> :
          <ul>
            @foreach ($levels as $level)
              @foreach ($formation->levels as $formation_level)
                @if($level->id == $formation_level->pivot->level_id)
                <li>{{ $level->name }} : {{ $formation_level->pivot->number_of_vacancies }} participant(s)</li>
                @endif
              @endforeach
            @endforeach
          </ul>

        </li>
        <li>
          <strong>Objectifs pédagogiques</strong> : {!! nl2br(e($formation->educational_objective)) !!}
        </li>
        <li>
          <strong>Ouverte à candidatures ?</strong> :
          @if($formation->send_email == true)
            Oui
          @else
            Non
          @endif
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection
