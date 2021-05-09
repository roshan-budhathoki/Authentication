<?php
    include 'config.php';
    echo "Enter the code sent in your database.";
    if(isset($_COOKIE["newUser"])){
    
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        
            $value = $_COOKIE["newUser"];
            echo $value;
            $db_code = mysqli_query($connect, "SELECT * FROM twofactor WHERE user_number = '$value'");
            $result = mysqli_fetch_assoc($db_code);
            if(mysqli_num_rows($db_code) > 0){
                if($code == $result['code']){
                    header('location: dashboard.php');
                }else{
                    echo "please enter the valid code";
                }
            }else{
                echo "No Value";
            }       
    }}else{
        header('location: login.php');
    }
?>

<html>
    <body>
        <form method = 'post'>
            <h2>Enter the code:</h2>
            <input type="text" name = 'code'><br><br>
            <input type="submit" name = 'submit'>
        </form>
    </body>
</html>