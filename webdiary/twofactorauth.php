<?php
include 'config.php';
    echo "Enter the code sent in your database.";
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        $values = $_COOKIE['newUsers'];
        echo $values;
        $db_code = mysqli_query($connect, "SELECT * FROM twofactor WHERE user_number = 0");
        $result = mysqli_fetch_assoc($db_code);
        if($code == $result['code']){
            header('location: dashboard.php');
        }else{
            echo "please enter the valid code";
        }
    }
?>

<html>
    <body>
        <form method = 'post'>
            <h2>Enter the code:</h2><br><br>
            <input type="text" name = "code"><br><br>
            <input type="submit" name = 'submit'>
        </form>
    </body>
</html>