@extends('template')

@section('title', ' - Gestion des formations')
@section('pageName', 'Gestion des formations')

@section('content')
  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Toutes les Formations</h4>
      <p class="card-category">Liste</p>
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
                <td>{{ $formation->date_start }}</td>
                <td>{{ $formation->date_end }}</td>
                @if($formation->send_email == false)
                  <td>Non</td>
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
