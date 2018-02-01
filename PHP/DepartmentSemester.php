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
$Semester = $_POST['Semester'];
$Department = $_POST['Department'];

$sql = "SELECT c.CourseTitle as 'Name'
FROM Course as c, Section as s 
WHERE c.CourseID = s.CourseID
AND c.DepartmentID = '$Department'
AND s.SemesterCode = '$Semester'
GROUP BY c.CourseTitle";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th></tr>";
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
