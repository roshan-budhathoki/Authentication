<?php

    include 'config.php';

    if(isset($_POST['submit'])){
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $reEnterPassword = $_POST['reEnterPassword'];

        if(empty($name) || empty($email) || empty($password) || empty($reEnterPassword)){
            echo "Please enter all the value";
        }else if ($password == $reEnterPassword){
            $hassedPassword = md5($_POST['password']);
            $query = mysqli_query($connect, "INSERT INTO user (user_name, user_email, user_password) VALUES ('$name', '$email', '$hassedPassword')");
            if($query){
                header('location: ./login.php');
            }
        }
    }
?>

<html>
    <form method = "post">
        <h3>Username</h3>
        <input type="text" name="username">
        <h3>Email</h3>
        <input type="text" name = "email">
        <h3>Password</h3>
        <input type="text" name = "password">
        <h3>Re-Enter Password</h3>
        <input type="text" name = "reEnterPassword"> <br/><br />
        <button name = "submit">Register</button>
    </form>
</html>