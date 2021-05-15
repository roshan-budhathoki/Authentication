<?php
    include "./assets/include/functions.php";
    if(!isset($_COOKIE['users'])){
        header('location: login.php');
    }
    if(isset($_POST['addStudent'])){
        $fullname = $_POST['studentfullname'];
        $email = $_POST['studentemail'];
        $password = $_POST['studentpassword'];

        $output = addStudent($fullname, $email, $password);
        echo $output;
    }
    if(isset($_POST['removeStudent'])){
        $email2 = $_POST['removeStudentEmail'];
        $output1 = deleteStudent($email2);
        echo $output1;
    }
    if(isset($_POST['addCourse'])){
        $title = $_POST['courseTitle'];
        $capacity = $_POST['studentCapacity'];
        $enrollDate = $_POST['enrollDate'];
        $courseadder = addCourse($title, $enrollDate, $capacity);
        echo $courseadder;
    }
    if(isset($_POST['deletecourse'])){
        var_dump($storage);
    }
    if(isset($_GET['del'])){
        $delete  = deleteCourse($_GET['del']);
        header('location: dashboard.php');
    }
    if(isset($_GET['id'])){
        enrollCourse($_COOKIE['users'],$_GET['id']);
        header('location: dashboard.php');
    }
?>
<html>
<head>
    <link href = "dashboard.css" rel = "stylesheet">
</head>
<body>
    <?php if(userType($_COOKIE['users']) == "admin"): ?>
        <div>
            <form method = "post">
                <div class = "adddingStudent">
                    <h1>Add Student</h1>
                    <h2>Student Full Name:</h2>
                    <input type="text" name = "studentfullname"><br>
                    <h2>Student Email</h2>
                    <input type="text" name = "studentemail"><br>
                    <h2>Student Password</h2>
                    <input type="text" name = "studentpassword"><br><br>
                    <button name = "addStudent" class = "addingStudent">Add Student</button>
                </div>
                <div class = "removingStudent">
                    <h1>Remove Student</h1>
                    <h2>Student Email</h2>
                    <input type="text" name = "removeStudentEmail"><br>
                    <button name = "removeStudent">Remove Student</button>
                </div>
                <div class = "AddingCourse">
                    <h1>Adding Course</h1>
                    <input type="text" name = "courseTitle" placeholder = "Course Title"><br>
                    <input type="date" name = "enrollDate" placeholder = "Enroll Date"><br>
                    <input type="text" name = "studentCapacity" placeholder = "Student Capacity"><br>
                    <button name = "addCourse" class = "addCourse">Add Course</button>
                </div>
                <div>
                    <h1>List of the course</h1>
                    <?php $courses = getCourse(); foreach($courses as $course){?>
                        <h1><?php echo $course[1]; ?></h1>
                        <a href="dashboard.php?del=<?php echo $course[0];?>">Delete Course</a>
                        <a href="editCourse.php?edit=<?php echo $course[0];?>"> Edit Course</a>
                    <?php } ?>
                </div>
            </form>
        </div>
    <?php else : ?>
        <div>
            <h1>Your name is <?php $studentDetail = getStudent($_COOKIE['users']); echo $studentDetail['username'];?></h1>
            <h2>List of the courses</h2>
            <?php $courses1 = getEnrollCourse(); foreach($courses1 as $course){?>
                        <h1><?php echo $course[1]; ?></h1>
                        <a href="dashboard.php?id=<?php echo $course[0];?>">Enroll Now </a>
            <?php } ?>
            <h3>Enrolled Courses</h3>
            <?php $enroll = getEnrolledCourse(); foreach($enroll as $course){?>
                        <h1><?php echo $course[1]; ?></h1>
                        <input type="text" value = "Enrolled" disabled>
            <?php } ?>
        </div>
    <?php endif; ?>
</body>
</html>