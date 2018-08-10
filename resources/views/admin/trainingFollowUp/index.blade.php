@extends('template')

@section('title', '- Suivi des formations')
@section('pageName', 'Suivi des formations')

@section('content')
  <div class="row">
    <!-- On affiche toutes les formations qui ne sont pas encore validé -->
    @if(!$formations->isEmpty())
    @foreach($formations as $formation)
      <div class="col-md-6" id='formation-{{ $formation->id }}'>
        <div class="card">
          <div class="card-header card-header-perso">
            <div class=" d-flex justify-content-between">
              <a href="{{ route('formations.show', $formation) }}">
                <h4 class="card-title">{{ $formation->name }}</h4>
              </a>
            {!! Form::open(['method' => 'POST', 'url' => route('training-follow-up.sendEmails', $formation->id)])!!}
              <button class="btn btn-warning btn-sm" type="submit">
                <i class="material-icons">mail</i>
                 Relance
              </button>
            {!! Form::close() !!}
          </div>
            <p class="card-category">
              Début dans <strong>{{ \Carbon\Carbon::parse($formation->date_start)->diffInDays($today) }}
                @if(\Carbon\Carbon::parse($formation->date_start)->diffInDays($today) == '1')
                  jour
                @else
                  jours
                @endif
              </strong>
            </p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!-- On affiche les niveaux demandés pour la formation en question -->
              @foreach ($formation->levels as $level)
                  <h5 class="text-gray mt-4 d-flex justify-content-between">
                    {{ $level->name }}
                    <span>{{ $level->pivot->number_of_vacancies }}</span>
                  </h5>

                <!-- On affiche tous les formateurs inscrits pour chaque niveau et chaque formation -->
                @foreach ($formation->trainers as $trainer)

                  {!! Form::open() !!}
                  @if(($trainer->level_id == $level->id) && ($trainer->pivot->answer_trainer == 'oui'))
                    <div class="d-flex justify-content-between">
                      <span>{{ $trainer->first_name }} {{ mb_strtoupper($trainer->last_name) }}</span>
                      <!-- Si answer_admin est true on coche la case sinon on la décoche -->
                      @if($trainer->pivot->answer_admin == true)
                        <input name="answer_admin" value="1" checked type="checkbox" id="trainer{{ $trainer->id }}-formation{{ $formation->id }}">
                      @else
                        <input name="answer_admin" value="1" type="checkbox" id="trainer{{ $trainer->id }}-formation{{ $formation->id }}">
                      @endif
                    </div>
                  @endif
                  {!! Form::close() !!}
                @endforeach
                <hr>
              @endforeach
            </div>
              {!! Form::open(['method' => 'PUT', 'url' => route('training-follow-up.validateFormation', $formation->id)]) !!}
              <button type="submit" class="btn btn-success btn-max">Valider</button>
              {!! Form::close() !!}
          </div>
        </div>
      </div>
    @endforeach
  @else
    Vous n'avez pas de formations en cours de traitement.
  @endif
  </div>
@endsection

@section('script')
  <script>
    let formationsLevels = [];
    let formations = [];
    $('input').click(function(){
      let infos;
      infos = $(this).attr('id');
      console.log(infos);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
        }
      });
      $.ajax({
        url: '/ajax',
        type: 'PUT',
        data: { infos: infos },
        dataType: 'JSON',
        success: function (data) {
          let formationId = data['formation'];
          let trainerId = data['trainer'];
          /*let levels = data['levels'];
          $('[id^=level]').html(0);
          for(let value in levels){
            $('#level' + value).html(levels[value]);
            ;
          }*/
        },
        error: function (e) {
          console.log('=========== ERREUR ==============');
          console.log(e.responseText);
        }
      });
    });
  </script>
@endsection
