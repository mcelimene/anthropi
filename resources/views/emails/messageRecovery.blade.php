<h1>Bonjour {{ $email['name_trainer'] }} !</h1>

<p>Vous n'avez toujours pas répondu à une demande d'inscription à une formation.</p>

@if($email['date_start'] == $email['date_end'])
<p>
  Elle aura lieu le <strong>{{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}}</strong>.
</p>
@else
  <p>
    Elle aura lieu du <strong>{{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}}</strong> au <strong>{{ \Carbon\Carbon::parse($email['date_end'])->format('d/m/Y')}}</strong>.
  </p>
@endif


<p>Pensez-bien à vous inscrire sur la plateforme d'<a href="http://localhost:8000">AnthroPi</a> dans l'onglet "Inscription" afin de candidater.</p>
<p>
  En vous remerciant,<br><br>
<em>L'équipe d'AnthroPi</em>
</p>
<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:10%;">
</figure>
