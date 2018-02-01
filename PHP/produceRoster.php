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
$SectionID = $_POST['SectionID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT concat(s.lname, ', ', s.fname) as 'Name' 
FROM Student as s, Student_Section as ss
WHERE ss.StudentID=s.StudentID
AND ss.SectionID = $SectionID
ORDER BY Name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 Results";
};
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT sum(ss.Grade_out_4)/count(ss.StudentID) as 'GPA'
FROM Student as s, Student_Section as ss
WHERE ss.StudentID=s.StudentID
AND ss.SectionID = $SectionID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Class GPA</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["GPA"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 Results";
};
$conn->close();
?>