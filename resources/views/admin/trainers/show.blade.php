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
      <h4 class="card-title ">{{ $trainer->first_name }} {{ $trainer->last_name }}</h4>
      <p class="card-category">Fiche</p>
    </div>
    <div class="card-body">
      <h5>Informations personnelles</h5>
      <ul>
        <li><strong>E-mail</strong> : {{ $trainer->user->email }}</li>
        <li><strong>Grade</strong> : {{ $trainer->rank }}</li>
        <li><strong>Niveau</strong> : {{ $trainer->level->name }}</li>
      </ul>
      <hr>
      <h5>Statistiques formations</h5>
      <ul>
        <li><strong>Nombre de formations proposées</strong> : {{ $nb_offer }}</li>
        <li>
          <strong>Nombre de formations acceptées</strong> : {{ $nb_answer['oui'] }} soit
          @if($nb_answer['oui'] != 0)
            {{ $nb_answer['oui']/$nb_offer * 100 }}%
          @else
            0%
          @endif
        </li>
        <li>
          <strong>Nombre de formations refusées</strong> :
          {{ $nb_answer['non'] }} soit
          @if($nb_answer['non'] != 0)
            {{ $nb_answer['non']/$nb_offer * 100 }}%
          @else
            0%
          @endif
        </li>
        <li>
          <strong>Non répondu</strong> : {{ $nb_answer['en_attente'] }} soit
          @if($nb_answer['en_attente'] != 0)
            {{ $nb_answer['en_attente']/$nb_offer * 100 }}%
          @else
            0%
          @endif
        </li>
      </ul>
    </div>
  </div>
@endsection
