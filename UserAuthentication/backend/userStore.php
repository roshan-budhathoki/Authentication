<?php
    include "connection.php";
    session_start();
    $do = $_GET['do'];
    if($do == "signin"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        $result = mysqli_fetch_assoc($query);

        if(mysqli_num_rows($query) > 0){
            if($result['password'] == md5($password)){
                $_SESSION['auth'] = $result['id'];

                $data = array('status' => 200, 'message' => "correct password.");
            }else{
                $data = array('status'=> 400, 'message'=> "incorrect password");
            }
        }else{
            $data = array('status' => 400, 'message' => "no user found");
        }
    }
    if($do == "register"){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        if(empty($name) || empty($password)){
            $query = mysqli_query($conn, "INSERT INTO user (email, password) values ('$email', '$password')");
            if($query){
                $data = array('status' => 200, 'message' => "Successfully registered");
            }
        }
    }

?>