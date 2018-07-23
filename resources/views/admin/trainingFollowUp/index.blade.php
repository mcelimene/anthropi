@extends('template')

@section('title', '- Suivi des formations')
@section('pageName', 'Suivi des formations')

@section('content')
  <div class="row">
    <!-- On affiche toutes les formations qui ne sont pas encore validé -->
    @foreach($formations as $formation)
      <div class="col-md-4">
        <div class="card">
          <div class="card-header card-header-perso">
            <h4 class="card-title">{{ $formation->name }}</h4>
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
                <h5 class="text-gray mt-4">
                  {{ $level->name }} <span class='compteur'>0</span>/{{ $level->pivot->number_of_vacancies }}
                </h5>

                <!-- On affiche tous les formateurs inscrits pour chaque niveau et chaque formation -->
                @foreach ($formation->trainers as $trainer)

                  {!! Form::open() !!}
                  @if(($trainer->level_id == $level->id) && ($trainer->pivot->answer_trainer == 'oui'))
                    <div class="d-flex justify-content-between">
                      <span>{{ $trainer->first_name }} {{ strtoupper($trainer->last_name) }}</span>
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
            <button type="button" class="btn btn-success btn-max">Valider</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@section('script')
  <script>
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
          $('.compteur').html(data);
          console.log(data);
        },
        error: function (e) {
          console.log('=========== ERREUR ==============');
          console.log(e.responseText);
        }
      });
    });
  </script>
@endsection
