<h1>Bonjour {{ $first_name }} !</h1>
<p>Une nouvelle formation vient d'être créer par AntroPi</p>

<p>
  Voici les éléments sur la formation :
  <ul>
    <li><strong>Nom</strong> : {{ $name }}</li>
    <li><strong>Lieu</strong> : {{ $place }}</li>
    <li><strong>Durée</strong> : Du {{ $date_start }} au {{ $date_end}}</li>
  </ul>
</p>

<p>Etes-vous disponible ?</p>

<a href="#">
  <button type="button" name="button">Oui</button>
</a>

<a href="#">
  <button type="button" name="button">Non</button>
</a>

En vous remerciant,

<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:20%;">
</figure>
