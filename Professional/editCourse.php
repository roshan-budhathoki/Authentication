<?php
    include "./assets/include/functions.php";

    if(isset($_GET['edit'])){
        $value = getCourses($_GET['edit']);
    }
    if(isset($_POST['addCourse'])){
        $title = $_POST['courseTitle'];
        $enrollDate = $_POST['enrollDate'];
        $storageCapacity = $_POST['studentCapacity'];

        updateCourse($_GET['edit'], $title, $enrollDate, $storageCapacity);
        header('location:dashboard.php');

    }
?>
<html>
    <body>
        <form method = "post">
        <h1>Updating Course</h1>
                    <input type="text" name = "courseTitle" value = "<?php echo $value['course_name']?>"><br>
                    <input type="date" name = "enrollDate" value = "<?php echo $value['enrolled_date'] ?>"><br>
                    <input type="text" name = "studentCapacity" value = "<?php echo $value['student_capacity']?>"><br>
                    <button name = "addCourse" class = "addCourse">Update Course</button>
        </form>
    </body>
</html>