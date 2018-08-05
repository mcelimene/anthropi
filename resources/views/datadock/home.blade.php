@extends('template')

@section('title', ' - Documents')
@section('pageName', 'Documents')

@section('content')
    <div class="card">
      <div class="card-header card-header-perso d-flex justify-content-between">
        <div>
          <h4 class="card-title ">Tous les fichiers</h4>
          <p class="card-category">Liste</p>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class=" text-primary">
              <th>Nom</th>
              <th>Créé le</th>
              <th>Afficher</th>
            </thead>
            <tbody>
              @foreach ($files as $file)
                <tr>
                  <td>{{ $file->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y')}}</td>
                  <td class="td-actions d-flex justify-content-around">
                    <a href="{{ url('storage/' . $file->path)}}">
                      <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                        <i class="material-icons">assignment</i>
                      </button>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-header card-header-perso d-flex justify-content-between">
        <div>
          <h4 class="card-title ">Tous les CV</h4>
          <p class="card-category">Liste</p>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class=" text-primary">
              <th>Nom et prénom du formateur</th>
              <th>Créé le</th>
              <th>Afficher</th>
            </thead>
            <tbody>
              @foreach ($trainers as $trainer)
                <tr>
                  <td>{{ mb_strtoupper($trainer->last_name)}} {{ $trainer->first_name}}</td>
                  <td>{{ \Carbon\Carbon::parse($trainer->created_at)->format('d/m/Y')}}</td>
                  <td class="td-actions d-flex justify-content-around">
                    <a href="{{ url('storage/' . $trainer->cv)}}">
                      <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                        <i class="material-icons">assignment</i>
                      </button>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection
