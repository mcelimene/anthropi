@extends('template')

@section('title', ' - Gestion des formateurs')
@section('pageName', 'Gestion des formateurs')

@section('content')
  @if(!$trainers->isEmpty())
    <div class="card">
      <div class="card-header card-header-perso d-flex justify-content-between">
        <div>
          <h4 class="card-title ">Tous les Formateurs</h4>
          <p class="card-category">Liste</p>
        </div>
        <div>
          <a href="{{ route('statistics',['download'=>'pdf']) }}">
            <button class="btn btn-warning btn-sm">
              <i class="material-icons">save_alt</i>
               Statistiques
            </button>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class=" text-primary">
              <th>Nom</th>
              <th>Prénom</th>
              <th>Région</th>
              <th>Profession</th>
              <th>Spécialité</th>
              <th>Niveau</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @foreach ($trainers as $trainer)
                <tr>
                  <td>{{ mb_strtoupper($trainer->last_name) }}</td>
                  <td>{{ $trainer->first_name }}</td>
                  <td>{{ $trainer->region->name }}</td>
                  <td>{{ $trainer->job }}</td>
                  <td>{{ $trainer->speciality }}</td>
                  <td>{{ $trainer->level->name }}</td>
                  <td class="td-actions d-flex justify-content-around">
                    <a href="{{ route('trainers.show', $trainer) }}">
                      <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                        <i class="material-icons">assignment</i>
                      </button>
                    </a>
                    <a href="{{ route('trainers.edit', $trainer) }}">
                      <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                        <i class="material-icons">edit</i>
                      </button>
                    </a>
                    {!! Form::open(['method'=>'delete', 'url' => route('trainers.destroy', $trainer->id), 'onsubmit' => 'return ConfirmDelete()']) !!}
                      <button type="submit" rel="tooltip" class="btn btn-danger btn-simple delete" data-id="{{ $trainer->id }}">
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
      {{ $trainers->render()}}
    </div>
  @else
    <p>Vous n'avez pas encore créé de formateurs</p>
    @endif

  <div class="d-flex justify-content-center">
    <a href="{{ route('trainers.create') }}">
      <button class="btn btn-perso">Ajouter un nouveau formateur</button>
    </a>
  </div>
@endsection


@section('script')
  <script>
    function ConfirmDelete() {
      let confirmation = confirm('Etes-vous sûr de vouloir supprimer ce formateur de la base de données ?');
      if(confirmation){
        return true;
     } else {
       return false;
     }
   };
  </script>
@endsection
