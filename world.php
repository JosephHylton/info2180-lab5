<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

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

// $lookup = filter_input(INPUT_GET,'query',FILTER_SANITIZE_STRING); //Initializes the search bar to search the array for what was entered.
// $found = false;//initializes found to false.

// $cname = $conn->query("SELECT name * FROM countries");

?>

<table>
<?php if ($context == 'cities'):?>
	<tr>
		<th>Name</th>
		<th>District</th>
		<th>Population</th>
	</tr>
	<?php foreach ($results as $row): ?>
    <tr>
      <th><?= $row['name']; ?></th>
      <th><?= $row['district']; ?></th>
      <th><?= $row['population']; ?></th>
    </tr>
  <?php endforeach; ?>

<?php else: ?>
	<tr>
		<th>Name</th>
		<th>Contintent</th>
		<th>Independence</th>
		<th>Head of State</th>
	</tr>
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



