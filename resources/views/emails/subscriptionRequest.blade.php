<h1>Bonjour {{ $email['nameTrainer'] }} !</h1>
<p>Une nouvelle formation vient d'être créée par AntroPi.</p>

<p>
  Elle aura lieu du <strong>{{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}}</strong> au <strong>{{ \Carbon\Carbon::parse($email['date_end'])->format('d/m/Y')}}</strong>.
</p>

<p>Etes-vous disponible ?</p>

<a href="#">
  <button type="button" name="button">Oui</button>
</a>

<a href="#">
  <button type="button" name="button">Non</button>
</a>
<p>
  En vous remerciant,<br><br>
<em>L'équipe d'AnthroPi</em>
</p>
<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:10%;">
</figure>
