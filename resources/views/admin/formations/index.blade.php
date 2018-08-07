@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formations')

@section('content')
<!-- Toutes les formations -->
@if(!$formations->isEmpty())
  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Formations</h4>
      <p class="card-category">Toutes</p>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class=" text-primary">
            <th>Statut</th>
            <th>Nom</th>
            <th>Lieu</th>
            <th>Date et heure de début</th>
            <th>Date et heure de fin</th>
            <th>Candidatures possibles ?</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($formations as $formation)
              <tr>
                @if($formation->validation_registrations == true)
                  <td><i class="material-icons">done</i></td>
                @else
                  <td><i class="material-icons">clear</i></td>
                @endif
                <td>{{ $formation->name }}</td>
                <td>{{ $formation->place }}</td>
                <td>{{ \Carbon\Carbon::parse($formation->date_start)->format('d/m/Y')}} à {{ \Carbon\Carbon::parse($formation->time_start)->format('H')}} heures</td>
                <td>{{ \Carbon\Carbon::parse($formation->date_end)->format('d/m/Y')}} à {{ \Carbon\Carbon::parse($formation->time_end)->format('H')}} heures</td>
                @if($formation->send_email == false)
                  <td><strong>Non</strong></td>
                @else
                  <td>Oui</td>
                @endif
                <td class="td-actions d-flex justify-content-around">
                  <a href="{{ route('formations.show', $formation) }}">
                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                      <i class="material-icons">assignment</i>
                    </button>
                  </a>
                  <a href="{{ route('formations.edit', $formation) }}">
                    <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                      <i class="material-icons">edit</i>
                    </button>
                  </a>
                  @if($formation->send_email == false)
                  {!! Form::open(['method' => 'DELETE', 'url' => route('formations.destroy', $formation->id), 'onsubmit' => 'return ConfirmDelete()']) !!}
                  <button type="submit" rel="tooltip" class="btn btn-danger btn-simple">
                    <i class="material-icons">close</i>
                  </button>
                  {!! Form::close() !!}
                @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@else
  <p>Vous n'avez pas créé de formations pour le moment</p>
@endif
  <div class="d-flex justify-content-center">
    <a href="{{ route('formations.create') }}">
      <button class="btn btn-perso">Ajouter une nouvelle formation</button>
    </a>
  </div>
  @if(!$upcoming_formations->isEmpty())
  <hr class="mt-5">
  <div class="card mt-5">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">A venir</h4>
      <p class="card-category">Formations</p>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class=" text-primary">
            <th>Date de début</th>
            <th>Nom</th>
            <th>Lieu</th>
            <th>Infos</th>
          </thead>
          <tbody>
            @foreach ($formations as $formation)
              @if(\Carbon\Carbon::parse($formation->date_start) > $today)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($formation->date_start)->format('d/m')}}</td>
                  <td>{{ $formation->name }}</td>
                  <td>{{ $formation->place }}</td>
                  <td class="td-actions d-flex justify-content-around">
                    <a href="{{ route('formations.show', $formation) }}">
                      <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                        <i class="material-icons">assignment</i>
                      </button>
                    </a>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
      {{ $formations->render()}}
    </div>
  </div>
  @endif
  @if(!$no_view_formations->isEmpty())
  <hr class="mt-5">

  <div class="card mt-5">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Non soumis à candidatures</h4>
      <p class="card-category">Formations</p>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class=" text-primary">
            <th>Date de début</th>
            <th>Nom</th>
            <th>Lieu</th>
            <th>Infos</th>
            <th>Modifier</th>
          </thead>
          <tbody>
            @foreach ($formations as $formation)
              @if($formation->send_email == false)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($formation->date_start)->format('d/m')}}</td>
                  <td>{{ $formation->name }}</td>
                  <td>{{ $formation->place }}</td>
                  <td class="td-actions">
                    <a href="{{ route('formations.show', $formation) }}">
                      <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                        <i class="material-icons">assignment</i>
                      </button>
                    </a>
                  </td>
                  <td class="td-actions">
                    <a href="{{ route('formations.edit', $formation) }}">
                      <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                        <i class="material-icons">edit</i>
                      </button>
                    </a>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif
@endsection


@section('script')
  <script>
    function ConfirmDelete() {
      let confirmation = confirm('Etes-vous sûr de vouloir supprimer cette formation de la base de données ?');
      if(confirmation){
        return true;
     } else {
       return false;
     }
   };
  </script>
@endsection
