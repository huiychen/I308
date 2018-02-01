<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
     border: 1px solid black;
}
</style>
</head>
<body>


<?php
$servername = "db.soic.indiana.edu";
$username = "i308s17_team24";
$password = "my+sql=i308s17_team24";
$dbname = "i308s17_team24";
$Features = $_POST['Features'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT r.RoomID as 'Room'
FROM Room as r, Classroom_Feature as cf
WHERE r.RoomID = cf.RoomID
AND cf.Feature = '$Features'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['Room']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
};
$conn->close();
?>