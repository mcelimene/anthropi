<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Statistiques</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>
		body {
			font-family: "Comic Sans MS", cursive, sans-serif;
		}
		h2 {
			padding: 0 20px;
			font-size: 1.3- em;
			color: #94b5e5;
		}
		td, th {
			padding: 0 15px;
		}
		td {
			width: 25%;
		}
		.show-logo {
			background-image: url({{ asset('images/logo.png')}});
		}
		</style>
	</head>
	<body class="container">
		<h1>Statistiques sur les formateurs d'AnthoPi</h1>
		<hr>
		<!-- 1. Formateurs qui ont le plus participés -->
		<h2>Formateurs ayant le plus participés aux formations</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de participations</th>
				<th>Taux de participation</th>
			</tr>
			@foreach ($data['formations_participated'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['formations_proposed'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_formations }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_formations), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<!-- 2. Formateurs qui ont le plus candidaté mais qui n'ont pas été retenu -->
		<h2>Formateurs ayant le plus candidatés mais qui ont été le moins retenus</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de refus</th>
				<th>Taux de refus</th>
			</tr>
			@foreach ($data['formations_refused'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['formations_proposed'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_formations }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_formations), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<!-- 3. Formateurs qui ont le plus répondu au mail de candidatures -->
		<h2>Formateurs ayant le plus répondus aux mails de candidature</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de réponses</th>
				<th>Taux de réponse</th>
			</tr>
			@foreach ($data['emails_response'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['emails_received'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->trainer_id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_emails }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_emails), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<!-- 4. Formateurs qui ont le plus répondu oui au mail de candidatures -->
		<h2>Formateurs ayant le plus répondus favorablement aux mails de candidature</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de réponses favorables</th>
				<th>Taux de réponse favorable</th>
			</tr>
			@foreach ($data['emails_favorable'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['emails_received'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->trainer_id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_emails }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_emails), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<!-- 5. Formateurs qui ont le plus répondu non au mail de candidatures -->
		<h2>Formateurs ayant le plus répondus défavorablement aux mails de candidature</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de réponses </th>
				<th>Taux de réponses défavorables</th>
			</tr>
			@foreach ($data['emails_unfavorable'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['emails_received'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->trainer_id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_emails }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_emails), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<hr>
		<!-- 6. Formateurs qui ont le moins répondu au mail de candidatures -->
		<h2>Formateurs ayant le moins répondus aux mails de candidature</h2>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Niveau</th>
				<th>Nombre de non-réponses</th>
				<th>Taux de non-réponse</th>
			</tr>
			@foreach ($data['emails_no_response'] as $data_trainer)
				<tr>
					<td>{{ mb_strtoupper($data_trainer->last_name )}} {{ $data_trainer->first_name }}</td>
					<td>{{ $data_trainer->level }}</td>
					@foreach ($data['emails_received'] as $nb_formations)
						@if ($nb_formations->trainer_id == $data_trainer->trainer_id)
							<td>{{ $data_trainer->trainer_count }} / {{ $nb_formations->nb_emails }}</td>
							<td>{{ number_format(($data_trainer->trainer_count/$nb_formations->nb_emails), 2) * 100 }}%</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
	</body>
</html>
