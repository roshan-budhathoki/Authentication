<?php
    include 'config.php';
    if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username) || empty($password)){
            echo ("Please enter all the value.");
        }else{

            //hash password

            $hassedPassword = md5($password);
            

            //Check user Existance

            $query = mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$hassedPassword'");
        
            if(mysqli_num_rows($query) > 0){

                //Fetch user id only when user exists.

                $result = mysqli_fetch_assoc($query);


                //generate random key

                    $randomValue = rand(1000, 10000);

                //store into data base {YOU ARE STORING USER ID INTO THE COOKIES } So {USER ID IS SAME AS COOKIE VALUE}  THATS WHY {WE WILL STORE USRE ID AND CREATE COOKIE ACCORDING TO ID}

                    $checker = mysqli_query($connect, "INSERT INTO twofactor (user_number, code) VALUES ('{$result['user_id']}', '$randomValue')");
                    
                    if($checker){
                    

                        //CREATE COOKIE WITH THE SAME USER ID WE STROED {CREATE COOKIE ONLY WHEN EVERY THING SUCCEED}

                        setcookie("newUser", $result['user_id'], time() + ( 7 * 24 * 60 * 60 ));

                        header('location: twofactorauth.php');


                        /*
                        NOTE;

                        $value = setcookie("newUsers", $result['user_id'], time() + ( 7 * 24 * 60 * 60 ));

                        $value will return 1 becaues it will check isset

                        $value = $_COOKIE['newUsers']

                        $value will return 0 because cookie is not yet created
                        
                        */
                    
                    }
                    
                    else{
                    
                        echo "Code is not generated.";
                    
                    }
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