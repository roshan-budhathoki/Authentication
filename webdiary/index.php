<?php
    include "config.php";

    if(isset($_COOKIE['newUser'])){
        setcookie('newUser', time() - (10 * 365 * 24 * 60 * 60 ));
    }
?>
<html>
    <body>
    <div class="indexContainer">
        <a href="./login.php"><button>Singin</button><br/></a>
        <h1>OR</h1><br/>
        <a href="./register.php"><button>Register</button></a>
    </div>    
    </body>   
</html>