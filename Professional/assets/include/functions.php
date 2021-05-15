<?php
    include 'config.php';
    $storage = [];
    
    $email_pattern = "/^([a-z\d\.-]+)@([a-z\d]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/";
    function login($email, $password){
        global $connect;
        $email_pattern = "/^([a-z\d\.-]+)@([a-z\d]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/";
        if(preg_match($email_pattern, $email) == 0){
            return "Email is not valid";
        }
        $emailValue =  $email;
            $hassedPassword = md5($password);
            $query = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email' AND password = '$hassedPassword'");
            $result = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) > 0){
                setcookie("users", $result['user_id'], time() + (20 * 60 * 60 * 7));
                header('location: dashboard.php');
            }
    }
    function userType($value){
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM user WHERE user_id = '$value'");
        $result = mysqli_fetch_assoc($query);
        $storage['result'] = $result;
        if($result['user_type'] == 1){
            return "admin";
        }else{
            return "student";
        }
    }

    // function for adding, removing student
    function addStudent($fullname, $email, $password){
        global $connect;
        if(empty($fullname) || empty($email) || empty($password)){
            return "Please Enter value on all the field";
        }
        $email_pattern = "/^([a-z\d\.-]+)@([a-z\d]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/";
        if(preg_match($email_pattern, $email) == 0){
            return "Email is not valid";
        } 
        $user_type = 0;
        $hassedPassword = md5($password);
        $checker = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
        if(mysqli_num_rows($checker) == 0){
            $query = mysqli_query($connect, "INSERT INTO user (username, email, password, user_type) VALUES ('$fullname', '$email', '$hassedPassword','$user_type')");
            if($query){
                return "Registration Success";
            }else{
                return "There must be error in database.";
            }
        }else{
            return "There is already an user with this email address.";
        }
        
    }
    function deleteStudent($email){
        global $connect;
        $email_pattern = "/^([a-z\d\.-]+)@([a-z\d]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/";
        if(preg_match($email_pattern, $email) == 0){
            return "Email is not valid";
        }
        $check = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
        if(mysqli_num_rows($check) == 0){
            return "There is no user with this email"; 
        }
        $query = mysqli_query($connect, "DELETE FROM user WHERE email = '$email'");
        if($query){
            return "Successfully Deleted";
        }
    }
    function addCourse($name, $date, $capacity){
        global $connect;
        
        if(empty($name) || empty($date) || empty($capacity)){
            return "Please, enter value on all field";
        }
        if(!is_numeric($capacity)){
            return "Please, enter integer value in capacity.";
        }
        $checker = mysqli_query($connect, "SELECT * FROM course WHERE course_name = '$name'");
        if(mysqli_num_rows($checker) > 0){
            return "There is already a course with this title.";
        }
        $query = mysqli_query($connect, "INSERT INTO course (course_name, student_capacity, enrolled_date) VALUES ('$name', '$capacity', '$date')");
        if($query){
            return "Course is added to the system.";
        }
    }
    function getCourse(){
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM course");
        $result = mysqli_fetch_all($query);
        return $result;
    }
    function getEnrollCourse($value){
        global $connect;
        $checker = mysqli_query($connect, "SELECT * FROM user_course WHERE user_id = '$value'");
        $query = mysqli_query($connect, "SELECT * FROM course");
        $courses = mysqli_fetch_all($query);
        return $result;
    }
    function getStudent($value){
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM user WHERE user_id = '$value'");
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
    function deleteCourse($value){
        global $connect;
        $query = mysqli_query($connect, "DELETE FROM course WHERE course_id = '$value'");
        return "Course Successfully deleted";
    }
    function getCourses($value){
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM course WHERE course_id = '$value'");
        $result = mysqli_fetch_assoc($query);
        return $result;
    }
    function updateCourse($id, $name, $date, $capacity){
        global $connect;
        $query = mysqli_query($connect, "UPDATE course SET course_name = '$name', enrolled_date = '$date', student_capacity = '$capacity' WHERE course_id = '$id'");
    }
    function enrollCourse($user_id, $course_id){
        $enrollStatus = True;
        $query = mysqli_query($connect, "INSERT INTO user_course (user_id, course_id, enrolled_status) VALUES ('user_id', '$course_id', '$enrollStatus')");
    }
    function getEnrolledCourse(){

    }
    function studentCourse(){

    }
?>