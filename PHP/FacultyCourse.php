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
$courseChoice = $_POST['courseChoice'];

$sql = "SELECT concat(f.lname, ', ', f.fname) as 'Name' 
FROM Faculty as f
Where Not Exists
(SELECT f.FacultyID as 'ID' 
FROM Course as c, Section as s
WHERE c.CourseTitle = '$courseChoice'
AND s.FacultyID = f.FacultyID
AND c.CourseID = s.CourseID
GROUP BY 'ID')
Order By 'Name' Desc";
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