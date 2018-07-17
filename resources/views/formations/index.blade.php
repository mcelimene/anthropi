@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formations')

@section('content')
  <div class="row">
    <!-- Formations en cours -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header card-header-perso">
          <h4 class="card-title ">En cours</h4>
          <p class="card-category">Formations</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Date de début</th>
                <th>Nom</th>
                <th>Lieu</th>
                <th>Infos</th>
              </thead>
              <tbody>
                @foreach ($formations as $formation)
                  @if((\Carbon\Carbon::parse($formation->date_start) == $today) || (\Carbon\Carbon::parse($formation->date_end) == $today) || ((\Carbon\Carbon::parse($formation->date_start) < $today) && (\Carbon\Carbon::parse($formation->date_end) > $today)))
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
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header card-header-perso">
          <h4 class="card-title ">A venir</h4>
          <p class="card-category">Formations</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
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
        </div>
      </div>
    </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header card-header-perso">
        <h4 class="card-title ">Non connu des candidats</h4>
        <p class="card-category">Formations</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
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
  </div>
</div>
  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Formations</h4>
      <p class="card-category">Toutes</p>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>Nom</th>
            <th>Lieu</th>
            <th>Date et heure de début</th>
            <th>Date et heure de fin</th>
            <th>E-mail envoyé ?</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($formations as $formation)
              <tr>
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
                  {!! Form::open(['method' => 'DELETE', 'route' => ['formations.destroy', $formation->id]]) !!}
                  <button type="submit" rel="tooltip" class="btn btn-danger btn-simple">
                    <i class="material-icons">close</i>
                  </button>
                  {!! Form::close() !!}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <a href="{{ route('formations.create') }}">
      <button class="btn btn-perso">Ajouter une nouvelle formation</button>
    </a>
  </div>
</div>
@endsection
