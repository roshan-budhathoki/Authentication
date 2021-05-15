<?php
    if(isset($_POST["toLoginPage"])){
        header('location: login.php');
    }
?>
<html>
    <link rel = "stylesheet" href="design.css">
    <body>
    <div class = "index">
    <form method = "post">
            <button class = "loginButton" name = "toLoginPage"> Login </button><br>
        </form>
    </div>        
    </body>
</html>