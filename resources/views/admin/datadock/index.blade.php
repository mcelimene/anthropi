@extends('template')

@section('title', ' - Datadock')
@section('pageName', 'Datadock')

@section('content')
  <div class="row">
    <div class="col-md-3 offset-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('datadock.dataTrainers')}}">
          <i class="material-icons fa-5x">group</i>
          <h4>Données formateurs</h4>
        </a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('datadock.create')}}">
          <i class="material-icons fa-5x">add</i>
          <h4>Ajouter un fichier</h4>
        </a>
      </div>
    </div>
    <div class="col-md-6 offset-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="">
          <i class="material-icons fa-5x">folder</i>
          <h4>Tous les documents</h4>
        </a>
      </div>
    </div>
  </div>
@endsection
