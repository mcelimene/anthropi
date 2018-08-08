<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Statistiques</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>
			td, th {
				padding: 0 30px;
				width: 50%;
			}
		</style>
	</head>
	<body class="container">
		<h1>Statistiques sur les formateurs d'AnthoPi</h1>
		<hr>
		<!-- 1. Formateurs qui ont le plus participés -->
		<h2>Formateurs ayant le plus participés aux formations</h2>
		<!-- 1. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Nombre de participations</th>
				<th>Taux de participation</th>
			</tr>
						@foreach ($data['statistics_total'] as $trainer_stats)
							<tr>
								<td>{{ mb_strtoupper($trainer_stats->last_name )}} {{ $trainer_stats->first_name }}</td>
								@foreach ($data['nb_formations_proposed'] as $nb_formations)
									@if ($nb_formations->trainer_id == $trainer_stats->id)
										<td>{{ $trainer_stats->trainer_count }} / {{ $nb_formations->nb_formations }}</td>
										<td>{{ number_format(($trainer_stats->trainer_count/$nb_formations->nb_formations), 2) * 100 }}%</td>
									@endif
								@endforeach
							</tr>
						@endforeach
		</table>
		<!-- 1. Par niveau -->
		<h3>Par niveau</h3>
		<table>
			<tr>
				<th>NOM Prénom</th>
				<th>Nombre de participations</th>
				<th>Taux de participation</th>
			</tr>
			@foreach ($data['levels'] as $level)
				<tr>
					<th colspan="4">{{ $level->name }}</th>
				</tr>
				@foreach ($data['statistics_total'] as $trainer_stats)
					@if($trainer_stats->level == $level->name)
					<tr>
						<td>{{ mb_strtoupper($trainer_stats->last_name )}} {{ $trainer_stats->first_name }}</td>
						@foreach ($data['nb_formations_proposed'] as $nb_formations)
							@if ($nb_formations->trainer_id == $trainer_stats->id)
								<td>{{ $trainer_stats->trainer_count }} / {{ $nb_formations->nb_formations }}</td>
								<td>{{ number_format(($trainer_stats->trainer_count/$nb_formations->nb_formations), 2) * 100 }}%</td>
							@endif
						@endforeach
					</tr>
				@endif
				@endforeach
			@endforeach
		</table>
		<!-- 2. Formateurs qui ont le plus candidaté mais qui n'ont pas été retenu -->
		<h2>Formateurs ayant le plus candidatés mais qui ont été le moins retenus</h2>
		<!-- 2. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<!-- 2. Par niveau -->
		<h3>Par niveau</h3>
		<!-- 3. Formateurs qui ont le plus répondu au mail de candidatures -->
		<h2>Formateurs ayant le plus répondus aux mails de candidature</h2>
		<!-- 3. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<!-- 3. Par niveau -->
		<h3>Par niveau</h3>
		<!-- 4. Formateurs qui ont le plus répondu oui au mail de candidatures -->
		<h3>Formateurs ayant le plus répondus favorablement aux mails de candidature</h3>
		<!-- 4. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<!-- 4. Par niveau -->
		<h3>Par niveau</h3>
		<!-- 5. Formateurs qui ont le plus répondu non au mail de candidatures -->
		<h3>Formateurs ayant le plus répondus défavorablement aux mails de candidature</h3>
		<!-- 5. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<!-- 5. Par niveau -->
		<h3>Par niveau</h3>
		<!-- 6. Formateurs qui ont le moins répondu au mail de candidatures -->
		<h3>Formateurs ayant le moins répondus aux mails de candidature</h3>
		<!-- 6. Niveaux confondus -->
		<h3>Niveaux confondus</h3>
		<!-- 6. Par niveau -->
		<h3>Par niveau</h3>
	</body>
</html>
