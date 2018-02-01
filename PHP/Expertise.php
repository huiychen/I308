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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT concat(a.fname,' ',a.lname) as 'Name', ae.Expertise as 'Expertise' From Advisor as a, Advisor_Expertise as ae WHERE ae.AdvisorID = a.AdvisorID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Expertise</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Name"]."</td><td>".$row["Expertise"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>