<?php
    include 'config.php';

    if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username) || empty($password)){
            echo ("Please enter all the value.");
        }else{
            $hassedPassword = md5($password);
            $query = mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$hassedPassword'");
            $result = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) > 0){
                    setcookie("newUser", $result['user_id'], time() + ( 24 * 60 * 60 ));
                    header('location: twofactorauth.php');
            }else{
                echo "no such user found";
            }
        }
    }
?>

<html>
    <form method = "post">
        <h3>Username</h3>
        <input type="text" name="username">
        <h3>Password</h3>
        <input type="text" name = "password">
        <br/> <br/>
        <button name='submit'>Login</button>
        <a href="forgetpassword.php">Forget Password</a>
    </form>
</html>