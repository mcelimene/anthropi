<style type="text/css">
table {
	 border-collapse: collapse;
}
	table td, table th{
		border:1px solid black;
	}
	img {
		width: 20%;
	}
</style>

<div class="container">
	<br/>
	<h1>AnthroPi</h1>
  <h2>Liste des formateurs</h2>
	<table>
		<tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>E-mail</th>
      <th>Région</th>
      <th>Grade</th>
      <th>Spécialité</th>
      <th>Niveau</th>
		</tr>
    @foreach ($trainers as $trainer)
      <tr>
        <td>{{ $trainer->last_name }}</td>
        <td>{{ $trainer->first_name }}</td>
        <td>{{ $trainer->email }}</td>
        <td>{{ $trainer->region->name }}</td>
        <td>{{ $trainer->rank }}</td>
        <td>{{ $trainer->speciality }}</td>
        <td>{{ $trainer->level->name }}</td>
      </tr>
    @endforeach
	</table>
</div>
