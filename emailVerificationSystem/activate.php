<?php

$con = mysqli_connect('localhost','root','','ee');

if(!isset($_GET['code']) || empty($_GET['code'])){

    echo "session expired";
}else{

   $query= mysqli_query($con,"SELECT * FROM cart WHERE product_id='{$_GET['code']}'");
    
}

if(mysqli_num_rows($query) > 0 ){

    $query= mysqli_query($con,"DELETE FROM cart WHERE product_id='{$_GET['code']}'");
    if($query){
        echo "user activated login again";
    }
}else{

    echo "no iser fino";
}


?>