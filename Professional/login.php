<?php
    
    include "./assets/include/functions.php";

    if(isset($_POST['studentLogin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checker = login($email, $password);

        echo $checker;
    }
?>


<html>
    <link rel = "stylesheet" href="design.css">
    <body>
    <div class = "studentLogin">
        <h1>Login</h1>
        <form method = "post">
            <h2>Email:</h2><br>
            <input type="text" name = "email"><br>
            <h2>Password:</h2><br>
            <input type="text" name = "password"><br><br>
            <input type="submit" name = "studentLogin" value= "Login">
        </form>
    </div>
    </body>
</html>

