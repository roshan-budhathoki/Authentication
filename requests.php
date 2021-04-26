<?php

require 'assets/init.php';

$f = '';
$s = '';
$data = array();

$page = '';

if (isset($_GET['f'])) {

    $f = $_GET['f'];

}

if (isset($_GET['s'])) {

    $s = $_GET['s'];
}

if ($f == 'getProduct') {

    $data = array('status' => 200, 'html' => loadPage('product'));
}

if ($f == 'cart') {

    $data = array('status' => 200, 'html' => loadPage('cart'));
}
if ($f == 'updateCart') {

    global $sqlConnect;

    if ($s == 'add') {

        $queryCheckExistance = mysqli_query($sqlConnect, "SELECT * FROM cart WHERE product_id='{$_POST['id']}' AND user_id='{$ry['user']['id']}' ");

        if (mysqli_num_rows($queryCheckExistance) > 0) {

            $fetch = mysqli_fetch_assoc($queryCheckExistance);

            $quantity = ($fetch['quantity']) + ($_POST['count']);

            $query = mysqli_query($sqlConnect, "UPDATE cart SET quantity='$quantity' WHERE product_id='{$_POST['id']}' AND user_id='{$ry['user']['id']}'");

        } else {

            $query = mysqli_query($sqlConnect, "INSERT INTO cart(product_id,user_id,quantity) VALUES('{$_POST['id']}','{$ry['user']['id']}','{$_POST['count']}')");

        }

        if ($query) {

            $data = array('status' => 200);
        }

    }

    if ($s == 'delete') {

        $query = mysqli_query($sqlConnect, "DELETE FROM cart WHERE user_id='{$ry['user']['id']}' AND product_id='{$_POST['id']}'");

        if ($query) {

            $data = array('status' => 200);
        }
    }

}

header("Content-type: application/json");
echo json_encode($data);
exit();
