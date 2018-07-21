@extends('template')

@section('title', ' - Envoi message groupé')
@section('pageName', 'Envoi message groupé')

@section('content')

  <a href="{{ url('/') }}">
    <button class="btn btn-default btn-sm">
      <i class="material-icons">arrow_back_ios</i>
      Retour
    </button>
  </a>

  <div class="card">
    <div class="card-header card-header-perso">
      <h4 class="card-title ">Message groupé</h4>
      <p class="card-category">Formulaire</p>
    </div>
    <div class="card-body">
      {!! Form::open([ 'url' => route('messages.send')]) !!}

      <div class="form-group">
        {!! Form::label('subject', 'Objet du message*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject']) !!}
      </div>
      @if ($errors->has('subject'))
        <div class="alert alert-danger" role="alert">
          <strong>{{ $errors->first('subject') }}</strong>
        </div>
      @endif


      <div class="form-group">
        {!! Form::label('level', 'Niveau*', ['class' => 'bmd-label-floating']) !!}
        {!! Form::select('level', $levels, null, [
          'class' => 'form-control',
          'id' => 'level',
          'placeholder' => 'Sélectionnez un niveau',
          'multiple' => true,
          'name' => 'level[]',
          'style' => 'height: 100px;']) !!}
        </div>
        @if ($errors->has('level'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('level') }}</strong>
          </div>
        @endif

        <div class="form-group">
          {!! Form::label('content', 'Message*', ['class' => 'bmd-label-floating']) !!}
          {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content']) !!}
        </div>
        @if ($errors->has('content'))
          <div class="alert alert-danger" role="alert">
            <strong>{{ $errors->first('content') }}</strong>
          </div>
        @endif


        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-perso">Envoyer</button>
        </div>

        {!! Form::close() !!}
      @endsection
