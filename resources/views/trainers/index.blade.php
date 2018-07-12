@extends('template')

@section('title', ' - Gestion des formateurs')
@section('pageName', 'Gestion des formateurs')

@section('content')
  <div class="card">
    <div class="card-header card-header-perso d-flex justify-content-between">
      <div>
        <h4 class="card-title ">Tous les Formateurs</h4>
        <p class="card-category">Liste</p>
      </div>
      <div>
        <a href="{{ route('pdfview',['download'=>'pdf']) }}">
          <button class="btn btn-warning btn-sm">
            <i class="material-icons">save_alt</i>
             PDF
          </button>
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead class=" text-primary">
            <th>Nom</th>
            <th>Prénom</th>
            <th>Pseudo</th>
            <th>E-mail</th>
            <th>Région</th>
            <th>Grade</th>
            <th>Spécialité</th>
            <th>Niveau</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($trainers as $trainer)
              <tr>
                <td>{{ $trainer->last_name }}</td>
                <td>{{ $trainer->first_name }}</td>
                <td>{{ $trainer->pseudo }}</td>
                <td>{{ $trainer->email }}</td>
                <td>{{ $trainer->region->name }}</td>
                <td>{{ $trainer->rank }}</td>
                <td>{{ $trainer->speciality }}</td>
                <td>{{ $trainer->level->name }}</td>
                <td class="td-actions d-flex justify-content-around">
                  <a href="{{ route('trainers.edit', $trainer) }}">
                    <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                      <i class="material-icons">edit</i>
                    </button>
                  </a>
                  {!! Form::open(['method' => 'DELETE', 'route' => ['trainers.destroy', $trainer->id]]) !!}
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
    <a href="{{ route('trainers.create') }}">
      <button class="btn btn-perso">Ajouter un nouveau formateur</button>
    </a>
  </div>
</div>
@endsection
