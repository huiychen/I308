--1B--

SELECT concat(s.lname, ', ', s.fname) as 'Name' 
FROM Student as s, Student_Section as ss
WHERE ss.StudentID=s.StudentID
AND ss.SectionID = $SectionID
ORDER BY Name; 

SELECT sum(ss.Grade_out_4)/count(ss.StudentID) as 'GPA'
FROM Student as s, Student_Section as ss
WHERE ss.StudentID=s.StudentID
AND ss.SectionID = $SectionID; 

--2B--

SELECT r.RoomID as 'Room'
FROM Room as r, Classroom_Feature as cf
WHERE r.RoomID = cf.RoomID
AND cf.Feature = '$Features'; 

--3B--

SELECT concat(f.lname, ', ', f.fname) as 'Name' 
FROM Faculty as f
Where Not Exists
(SELECT f.FacultyID as 'ID' 
FROM Course as c, Section as s
WHERE c.CourseTitle = '$courseChoice'
AND s.FacultyID = f.FacultyID
AND c.CourseID = s.CourseID
GROUP BY 'ID')
ORDER BY 'Name' Desc; 

--5B--

SELECT c.CourseTitle as 'Course', ss.Grade_out_4 as 'Grade'
FROM Course as c, Student_Section as ss, Section as s
WHERE ss.SectionID = s.SectionID
AND c.CourseID = s.CourseID
AND ss.StudentID = '$Student'
ORDER BY s.SemesterCode;

SELECT SUM(c.cr_hr) as 'Total Credit Hours',  SUM(ss.Grade_out_4*c.cr_hr)/(count(ss.SectionID)*c.cr_hr) as 'GPA'
FROM Course as c, Student_Section as ss, Section as s
WHERE ss.SectionID = s.SectionID
AND c.CourseID = s.CourseID
AND ss.StudentID = '$Student';

--6C--

SELECT concat(a.lname, ', ', a.fname) as 'Name'
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
GROUP BY 'Name';

--7A--

SELECT concat(s.lname, ', ', s.fname) as 'Name', m.Major_Title as 'Major'
FROM Student as s, Major as m, Student_Major as sm, Student_Advisor as sa, Advisor as a
WHERE sm.StudentID = s.StudentID
AND sm.MajorID = m.MajorID 
AND sa.StudentID = s.StudentID 
AND sa.AdvisorID = a.AdvisorID
AND a.AdvisorID = $Advisor
GROUP BY Name
ORDER BY Name;

--Additional Queries--

SELECT concat(s.fname,' ',s.lname) as 'Name', se.Email as 'Email' 
FROM Student as s, Student_Email as se 
WHERE se.StudentID = s.StudentID
UNION 
SELECT concat(f.fname,' ',f.lname) as 'Name', fe.Email as 'Email' 
FROM Faculty as f, Faculty_Email as fe 
WHERE fe.FacultyID = f.FacultyID;

SELECT concat(s.fname,' ',s.lname) as 'Name', sp.Phone as 'Phone' 
FROM Student as s, Student_Phone as sp 
WHERE sp.StudentID = s.StudentID;

SELECT CourseID as 'Course', PrereqID as 'Prereq' From Course_prereq;

SELECT concat(a.fname,' ',a.lname) as 'Name', ae.Expertise as 'Expertise' 
FROM Advisor as a, Advisor_Expertise as ae 
WHERE ae.AdvisorID = a.AdvisorID;

SELECT c.CourseTitle as 'Name'
FROM Course as c, Section as s 
WHERE c.CourseID = s.CourseID
AND c.DepartmentID = '$Department'
AND s.SemesterCode = '$Semester'
GROUP BY c.CourseTitle;