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
$Student = $_POST['Student'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "Select c.CourseTitle as 'Course', ss.Grade_out_4 as 'Grade'
From Course as c, Student_Section as ss, Section as s
Where ss.SectionID = s.SectionID
AND c.CourseID = s.CourseID
AND ss.StudentID = '$Student'
Order by s.SemesterCode";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Course</th><th>Grade</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Course"]."</td><td>".$row["Grade"]."</td></tr>";
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

$sql = "Select SUM(c.cr_hr) as 'Total Credit Hours',  SUM(ss.Grade_out_4*c.cr_hr)/(count(ss.StudentID)*c.cr_hr) as 'GPA'
From Course as c, Student_Section as ss, Section as s
Where ss.SectionID = s.SectionID
AND c.CourseID = s.CourseID
AND ss.StudentID = '$Student'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Total Credit Hours</th><th>GPA</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Total Credit Hours"]."</td><td>".$row["GPA"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 Results";
};
$conn->close();
?>