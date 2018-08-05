@extends('template')

@section('title', '- Tableau de bord')
@section('pageName', 'Tableau de bord')

@section('content')
        <div class="row">
    <div class="col-md-3 offset-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('messages.create')}}">
          <i class="material-icons fa-5x">email</i>
          <h4>Message groupé</h4>
        </a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('profils.edit', $admin->id) }}">
          <i class="material-icons fa-5x">person</i>
          <h4>Profil</h4>
        </a>
      </div>
    </div>
    <div class="col-md-3 offset-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('users.create') }}">
          <i class="material-icons fa-5x">group_add</i>
          <h4>Nouvel administrateur</h4>
        </a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-home d-flex align-items-center justify-content-center">
        <a href="{{ route('levels.create') }}">
          <i class="material-icons fa-5x">description</i>
          <h4>Nouveau niveau</h4>
        </a>
      </div>
    </div>
  </div>

@endsection
