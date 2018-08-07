@extends('template')

@section('title', '- Tableau de bord')
@section('pageName', 'Tableau de bord')

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center title-blue">Vos statistiques</h2>
      <hr class="hr-blue">
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
  @if(!$formations->isEmpty())
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center title-blue">Vos prochaines formations</h2>
      <hr class="hr-blue">
      @if($formations)
        <ul class="num-formations">
        @foreach ($formations as $formation)
          <h3>{{ $formation->place }}</h3>
          <p>Du <strong>{{ \Carbon\Carbon::parse($formation->date_start)->format('d/m/Y') }}</strong> à {{ \Carbon\Carbon::parse($formation->time_start)->format('h:i') }} H au <strong>{{ \Carbon\Carbon::parse($formation->date_end)->format('d/m/Y')}}</strong> à {{ \Carbon\Carbon::parse($formation->time_end)->format('h:i')}}H</p>
          <hr>
        @endforeach
      </ul>
      @else
        <p>Vous n'avez pas de formations dans les prochains jours</p>
      @endif
    </div>
  </div>
@endif

@endsection
