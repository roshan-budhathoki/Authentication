<?php

$con = mysqli_connect('localhost','root','','ee');

$query = mysqli_query($con,"SELECT * FROM products");


// $result= mysqli_fetch_assoc($query);

$result= mysqli_fetch_all($query,MYSQLI_ASSOC);

foreach ($result as $key) {
    

echo $key['image'];

}






var_dump($result);
// while($r = mysqli_fetch_assoc($query)){


// }



?>