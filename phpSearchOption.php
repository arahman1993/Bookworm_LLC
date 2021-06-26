<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
<body>

<?php

$search = $_POST['search'];
$column = $_POST['column'];

$servername = "localhost";
$username = "root";
$password = "";
$db = "BookwormLLC";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}
echo "Connected successfully". "<br>". "<br>";


$sql = "select * from Book where $column like '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
echo "<table class='table table-striped'>";
while($row = $result->fetch_assoc() ){
	echo "<tr>";
	echo "<td>".$row["title"]."</td><td>".$row["Author"]."</td><td>".$row["ISBN"]."</td><td>".$row["Publisher"]."</td><td>".$row["Edition"]."</td><td>".$row["price"]."</td>";
	echo "</tr>";

}
echo "</table>";

} else {
	echo "0 records";
}
$conn->close();

?>
</body>
</html>
