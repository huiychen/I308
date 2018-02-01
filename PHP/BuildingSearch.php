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
$Building = $_POST['Building'];
$SearchTime = $_POST['SearchTime'];

$sql = "SELECT concat(a.lname, ', ', a.fname) as 'Name'
FROM Building as b, Room as r, Advisor as a
WHERE a.RoomID = r.RoomID
AND b.BuildingCode = r.BuildingCode
AND b.BuildingCode = '$Building'
UNION
SELECT concat(s.lname, ', ', s.fname) as 'Name'
FROM Student as s, Section as sc, Room as r, Student_Section as ss
WHERE r.BuildingCode = '$Building'
AND s.StudentID = ss.StudentID
AND sc.RoomID = r.RoomID
AND sc.SectionID = ss.SectionID
AND ('$SearchTime'  Between sc.Start_Time and sc.End_Time)
UNION
SELECT concat(f.lname, ', ', f.fname) as 'Name'
FROM Faculty as f, Section as sc, Room as r, Student_Section as ss
WHERE r.BuildingCode = '$Building'
AND sc.RoomID = r.RoomID
AND f.FacultyID  = sc.FacultyID
AND ('$SearchTime'  Between sc.Start_Time and sc.End_Time)
GROUP BY 'Name'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['Name']."</td></tr>";
    }	
    echo "</table>";
} else {
    echo "Zero Results";
};
$conn->close();
?>