@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formateurs')

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
          <strong>Dates</strong> : Du {{ $formation->date_start }} au {{ $formation->date_end }}
        </li>
        <li>
          <strong>Nombre de participants</strong> :
          @if($formation->number_of_trainers > 0)
            {{ $formation->number_of_trainers }} formateur(s)/
          @endif
          @if($formation->number_of_assistant_trainers > 0)
            {{ $formation->number_of_assistant_trainers }} assistant-formateur(s)/
          @endif
          @if($formation->number_of_instructors > 0)
            {{ $formation->number_of_instructors }} instructeur(s)/
          @endif
          @if($formation->number_of_course_directors > 0)
            {{ $formation->number_of_course_directors }} directeur(s) de cours
          @endif
        </li>
        <li>
          <strong>Objectifs pédagogiques</strong> : {{ $formation->educational_objective }}
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
