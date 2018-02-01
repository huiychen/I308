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
$Advisor = $_POST['Advisor'];

$sql = "SELECT concat(s.lname, ', ', s.fname) as 'Name', m.Major_Title as 'Major'
FROM Student as s, Major as m, Student_Major as sm, Student_Advisor as sa, Advisor as a
WHERE sm.StudentID = s.StudentID
AND sm.MajorID = m.MajorID 
AND sa.StudentID = s.StudentID 
AND sa.AdvisorID = a.AdvisorID
AND a.AdvisorID = $Advisor
Group BY Name
ORDER BY Name";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th> <th>Major</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['Name']."</td><td>".$row['Major']."</td></tr>";
    }	
    echo "</table>";
} else {
    echo "Zero Results";
};
$conn->close();
?>