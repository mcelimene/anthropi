<h1>Bonjour {{ $first_name }} !</h1>
<p>Vous êtes désormais inscrit sur la plateforme d'AntroPi</p>

<p>
  Vous pouvez dès maintenant vous connectez avec votre mot de passe : <strong> {{ $password }}</strong>.<br>
  Vous pouvez le changer depuis les paramètres de votre compte.
</p>
<a href="http://localhost:8000">Cliquez ici pour accéder au site.</a>

<p>A bientôt !</p>

<p>
  <em>L'équipe d'AnthoPi</em>
</p>
<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:10%;">
</figure>
