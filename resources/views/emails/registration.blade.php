<h1>Bonjour {{ $first_name }} !</h1>
<p>Vous êtes désormais inscrit sur la plateforme d'AntroPi</p>

<p>
  Vous pouvez dès maintenant vous connectez avec vos identifiants :
  <ul>
    <li><strong>Pseudo</strong> : {{ $pseudo }}</li>
    <li><strong>Mot de passe</strong> : {{ $password }}</li>
  </ul>
</p>
<a href="http://localhost:8000">Cliquez ici !</a>

<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:20%;">
</figure>
