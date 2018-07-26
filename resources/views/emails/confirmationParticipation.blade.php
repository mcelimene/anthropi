<h1>Bonjour {{ $email['name_trainer'] }} !</h1>
<p>Votre inscription à la formation du {{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}} au {{ \Carbon\Carbon::parse($email['date_end'])->format('d/m/Y')}} a été retenue</p>

<p>
  Veuillez trouver ci-dessus les informations relatives à cette formation :
  <ul>
    <li><strong>Lieu </strong> : {{ $email['place']}} </li>
    <li><strong>Date et heure de début </strong> : {{ \Carbon\Carbon::parse($email['date_start'])->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($email['time_start'])->format('h:i')}}H </li>
    <li><strong>Date et heure de début </strong> : {{ \Carbon\Carbon::parse($email['date_end'])->format('d/m/Y')}} - {{ \Carbon\Carbon::parse($email['time_end'])->format('h:i')}}H </li>
  </ul>
</p>

<em>L'équipe d'AnthroPi</em>
</p>
<figure>
  <img src="{{ asset('images/logo.png')}}" alt="Logo AntroPi" style="width:10%;">
</figure>
