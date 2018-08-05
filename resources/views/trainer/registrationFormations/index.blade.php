@extends('template')

@section('title', '- Inscriptions aux formations')
@section('pageName', 'Inscriptions aux formations')

@section('content')
  <div class="row">
    @if(!$formations->isEmpty())
      <!-- On affiche toutes les formations qui ne sont pas encore validé -->
      @foreach($formations as $formation)
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-perso">
              <h4 class="card-title">Formation du {{ \Carbon\Carbon::parse($formation->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($formation->end_start)->format('d/m/Y') }} </h4>
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
                <h5 class="text-center">Souhaitez-vous participer à cette formation ?</h5>
                {!! Form::open(['method' => 'POST', 'url' => route('registration-formations.store', $formation->id)])!!}
                <div class="d-flex justify-content-around">
                  <input type="text" name="formation_id" value="{{ $formation->id }}" hidden>
                  <button type="submit" name="choice" class="btn btn-success btn-lg" value="oui">OUI</button>
                  <button type="submit" name="choice" class="btn btn-danger btn-lg" value='non'>NON</button>
                </div>
                {!! Form::close()!!}
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @else
        <p>Vous n'avez pas de demande d'inscription pour le moment</p>
      @endif
  </div>
@endsection
