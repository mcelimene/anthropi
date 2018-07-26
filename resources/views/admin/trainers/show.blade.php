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
        <li><strong>Date de naissance </strong> : {{ \Carbon\Carbon::parse($trainer->birthdate)->format('d/m/Y')}}</li>
        <li><strong>E-mail</strong> : {{ $trainer->user->email }}</li>
        <li><strong>Numéro de téléphone </strong> : {{ $trainer->phone_number }}</li>
        <li><strong>Adresse</strong> : {{ $trainer->address }}</li>
        <li><strong>Numéro de sécurité sociale</strong> : {{ $trainer->social_security }}</li>
        <li><strong>Profession</strong> : {{ $trainer->job }}</li>
        <li><strong>Niveau</strong> : {{ $trainer->level->name }}</li>
        <li>
          <strong>Ancienneté</strong> : {{ \Carbon\Carbon::parse($trainer->senority)->diffInYears($today) }}
          @if (\Carbon\Carbon::parse($trainer->senority)->diffInYears($today) == 1)
            an
          @else
            ans
          @endif
        </li>
        @if($trainer->cv)
          <li><strong>CV</strong> : <a href="{{ url('storage/' . $trainer->cv)}}">Voir</a> </li>
        @endif
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
