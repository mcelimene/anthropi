<h1>Bonjour {{ $email['nameTrainer'] }} !</h1>
<p>Une nouvelle formation vient d'être créée par AntroPi.</p>

@if($email['date_start'] == $email['date_end'])
  Elle aura lieu le <strong>{{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}}</strong>.
</p>
@else
  <p>
    Elle aura lieu du <strong>{{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}}</strong> au <strong>{{ \Carbon\Carbon::parse($email['date_end'])->format('d/m/Y')}}</strong>.
  </p>
@endif

<p>Veuillez vous <a href="{{ env('APP_URL') }}">connecter à votre compte</a> afin de candidater.</p>
<p>
  En vous remerciant,<br><br>
<em>L'équipe d'AnthroPi</em>
</p>
<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:10%;">
</figure>
