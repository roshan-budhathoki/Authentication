<?php
    include 'config.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $newPassword = $_POST['newPassword'];
        $reenterPassword = $_POST['reenterPassword'];

        if(empty($newPassword) || empty($reenterPassword) || empty($username) ){
            echo "Please enter the value on all field.";
        }
        else if($newPassword == $reenterPassword){
            $hassedPassword = md5($newPassword);
            $query = mysqli_query($connect, "UPDATE user SET user_password = '$hassedPassword' WHERE user_name = '$username'");
            if ($query == TRUE ){
                echo "password changed successfully.";
            }else{
                echo "it cannot be changed";
            }
        }else{
            echo "please enter different password";
        }
    }
?>

<html>
    <form method = "post">
    Username:<br>
    <input type="text" name = "username"><br>
    New Password: <br></br>
    <input type="text" name="newPassword"/><br></br>
    Re-Enter New Password:<br></br>
    <input type="text" name="reenterPassword"></br></br>
    <button name = 'submit'>Update Password</button>
    </form>
</html>

<!-- a8a64cef262a04de4872b68b63ab7cd8 -->