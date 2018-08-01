<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Liste des formateurs</title>
    <style type="text/css">
      table {
    	   border-collapse: collapse;
       }
    	table td, table th{
    		border:1px solid black;
    	}
      ul {
        list-style-type: none;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <h1>AnthroPi</h1>
      <h2>Liste des formateurs</h2>
      @foreach ($trainers as $trainer)
        <hr>
        <h3>{{ mb_strtoupper($trainer->last_name) }} {{ $trainer->first_name }}</h3>
        <ul>
          <!-- Date de naissance -->
          @if($trainer->birthdate)
            <li><strong>Date de naissance</strong> : {{ \Carbon\Carbon::parse($trainer->birthdate)->format('d/m/Y')}} </li>
          @endif
          <!-- Adresse -->
          @if($trainer->address)
            <li><strong>Adresse</strong> : {{ $trainer->address }} </li>
          @endif
          <!-- Region -->
          @if($trainer->region_id)
            <li><strong>Region</strong> : {{ $trainer->region->name }} </li>
          @endif
          <!-- Numéro de téléphone -->
          @if($trainer->phone_number)
            <li><strong>Téléphone</strong> : {{ $trainer->phone_number }} </li>
          @endif
          <!-- Numéro de sécurité sociale -->
          @if($trainer->social_security)
            <li><strong>Numéro de sécurité sociale</strong> : {{ $trainer->social_security }} </li>
          @endif
          <!-- Profession -->
          @if($trainer->job)
            <li><strong>Profession</strong> : {{ $trainer->job }} </li>
          @endif
          <!-- Spécialité -->
          @if($trainer->speciality)
            <li><strong>Spécialité</strong> : {{ $trainer->speciality }} </li>
          @endif
          <!-- Niveau -->
          @if($trainer->level_id)
            <li><strong>Niveau</strong> : {{ $trainer->level->name }} </li>
          @endif
          <!-- Date de début de prise de fonction -->
          @if($trainer->senority)
            <li><strong>Date de début de prise de fonction</strong> : {{ \Carbon\Carbon::parse($trainer->senority)->format('d/m/Y')}} </li>
          @endif
        </ul>
      @endforeach
    	</table>
    </div>
  </body>
</html>
