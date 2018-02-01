<!doctype html>
<html>
<body>
<h1>Final Project</h1>
<h2>Roster Generation</h2>
<p><b>1b) Produce a roster for a *specified section* sorted by student's last name, first name.</b></p>
<form action="produceRoster.php" method="POST">
Section ID: <select name='SectionID'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT SectionID, SemesterCode FROM Section");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($sid, $bname);
                  $sid = $row['SectionID'];
                  $bname = $row['SemesterCode']; 
                  echo '<option value="'.$sid.'">'.$sid.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Generate Roster">
</form>

<h2>Room Features</h2>
<p><b>2b) Produce a list of rooms that are equipped with *some feature*.</b></p>
<form action="roomFeatures.php" method="POST">
Features: <select name='Features'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT Feature FROM Classroom_Feature GROUP BY Feature");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($feature, $cname);
                  $feature = $row['Feature'];
                  $cname = $row['Feature']; 
                  echo '<option value="'.$cname.'">'.$feature.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Show Classrooms">
</form>

<h2>Find Faculty</h2>
<p><b>3b) Produce a list of faculty who have never taught a *specified course*.</b></p>
<form action="FacultyCourse.php" method="POST">
Course: <select name='courseChoice'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT CourseID, CourseTitle FROM Course");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($id, $dname);
                  $id = $row['CourseTitle'];
                  $dname = $row['CourseTitle']; 
                  echo '<option value="'.$id.'">'.$dname.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Show Faculty">
</form>

<h2>Student Transcript</h2>
<p><b>5b) Produce a chronological list of all courses taken by a *specified student*. Show grades
earned. Include overall hours taken and GPA at the end.</b></p>
<form action="Transcript.php" method="POST">
Student: <select name='Student'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT Concat(lname,', ',fname) as 'name', StudentID as 'id' FROM Student");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($id, $dname);
                  $id = $row['id'];
                  $hname = $row['name']; 
                  echo '<option value="'.$id.'">'.$hname.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Show Transcript">
</form>


<h2>Building Search</h2>
<p><b>6c) Produce a list of students and faculty who were in a *particular building* at a *particular

time*. Also include in the list faculty and advisors who have offices in that building.</b></p>

<form action="BuildingSearch.php" method="POST">
Building: <select name='Building'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT BuildingCode, Name FROM Building");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($feature, $name);
                  $id = $row['BuildingCode'];
                  $ename = $row['Name']; 
                  echo '<option value="'.$id.'">'.$ename.'</option>';
}
?>
</select>
</br>
</br>
Time: <input type= "time" name= "SearchTime" required><br>
</br>
<input type="submit" name="submit" value="Search Building">
</form>



<h2>Advisor Roster</h2>
<p><b>7a) Produce an alphabetical list of students with their majors who are advised by a

*specified advisor*.</b></p>

<form action="advisorsearch.php" method="POST">
Advisor: <select name='Advisor'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT AdvisorID, concat(fname, ' ', lname) as Name FROM Advisor");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($feature, $fname);
                  $id = $row['AdvisorID'];
                  $fname = $row['Name']; 
                  echo '<option value="'.$id.'">'.$fname.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Show Students">
</form>

<h2>Additional Queries</h2>
<p><b>Email Table:</b></p>
<form action="email.php" method="post">
<input type="submit" name="submit" value="Student and Faculty Emails">
</form>
</br>
<p><b>Student Phone Table:</b></p>
<form action="phone.php" method="post">
<input type="submit" name="submit" value="Student Phones">
</br>
</form>
<p><b>Prerequisite Table:</b></p>
<form action="prerequisite.php" method="post">
<input type="submit" name="submit" value="Show Prerequisites">
</form>
</br>
<p><b>Advisor Expertise Table:</b></p>
<form action="Expertise.php" method="post">
<input type="submit" name="submit" value="Check Expertise">
</form>
</br>

<p><b>Department/Semester:</b></p>
<p><b>Show which courses are offered during a specified semester and department:</b></p>
<form action="DepartmentSemester.php" method="POST">
Department: <select name='Department'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT DepartmentID, DepartmentTitle FROM Department");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($feature, $gname);
                  $id = $row['DepartmentID'];
                  $gname = $row['DepartmentTitle']; 
                  echo '<option value="'.$id.'">'.$gname.'</option>';
}
?>
</select>
</br>
</br>

Semester: <select name='Semester'>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308s17_team24","my+sql=i308s17_team24","i308s17_team24");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $result = mysqli_query($conn,"SELECT SemesterCode, Title FROM Semester");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($feature, $hname);
                  $id = $row['SemesterCode'];
                  $hname = $row['Title']; 
                  echo '<option value="'.$id.'">'.$hname.'</option>';
}
?>
</select>
</br>
</br>
<input type="submit" name="submit" value="Find Course">
</body>
</html>
