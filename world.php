<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Initiates the connection.
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = filter_input(INPUT_GET,'country',FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET,'context',FILTER_SANITIZE_STRING);

if ($context == "cities") {
	$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}
// $stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
<?php if ($context == 'cities'):?>
  <!-- table headers for cities table. -->
	<tr>
		<th>Name</th>
		<th>District</th>
		<th>Population</th>
	</tr>
  <!-- Fills the table with the respective record for each city header -->
	<?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['district']; ?></td>
      <td><?= $row['population']; ?></td>
    </tr>
  <?php endforeach; ?>

<?php else: ?>
  <!-- table header for countries table. -->
	<tr>
		<th>Name</th>
		<th>Contintent</th>
		<th>Independence</th>
		<th>Head of State</th>
	</tr>
  <!-- Fills the table with the respective record for each city header -->
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach; ?>
<?php endif ?>
</table>



