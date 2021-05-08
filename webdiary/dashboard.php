<?php
    include "config.php";
    if(isset($_POST['submit'])){
    $value = $_COOKIE['newUser'];
    $query = mysqli_query($connect, "SELECT * FROM user WHERE user_id = '$value'");
    $result = mysqli_fetch_assoc($query);
    $details = mysqli_query($connect, "SELECT * FROM details WHERE user_id = '$value'");
    echo "your name is " . $result['user_name'];
    
        if(mysqli_num_rows($details) > 0){
            echo "you response has already been recorded";
        }else{  
        $response = $_POST['response'];
        $enter = mysqli_query($connect, "INSERT INTO details (detail_description, user_id) VALUES ('$response', '$value')");
        if($enter){
            echo  "Thank you for your response" ;
        }
    }
}
?>

<html>
    <form method = "post">
        Response: <br/><br/>
        <textarea name="response" id="text12" cols="30" rows="10"></textarea><br/><br/>
        <button  name = "submit">Send Response</button>
    </form>
</html>