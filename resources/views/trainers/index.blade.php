@extends('template')

@section('content')
  <div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title ">Tous les Formateurs</h4>
    <p class="card-category">Liste</p>
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
              <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                    <i class="material-icons">person</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                    <i class="material-icons">edit</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-danger btn-simple">
                    <i class="material-icons">close</i>
                </button>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="d-flex justify-content-center">
  <button class="btn btn-primary">Ajouter un nouveau formateur</button>
</div>
</div>
@endsection
