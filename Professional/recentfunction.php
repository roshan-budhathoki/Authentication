<?php
include "./assets/include/config.php";
function secure_sanitize($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    echo $input;
}
secure_sanitize("<h1>I am roshan</h1>");
//function that returns ip address and browser details
function get_ip_browserdetail()
{
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    echo $ip_address;
    echo $_SERVER['HTTP_USER_AGENT'];
}
// function that takes similar parameter and inserts data into db
$data = array(
    'name' => 'name',
    'value' => 'value',
);
function insert_into_db($table, $data)
{
    global $connect;
    $column = array_keys($data);
    echo $column;
    $values = json_encode(array_values($data));
    echo $values;
    mysqli_query($connect, "INSERT INTO '$table' ('$column') VALUES ('$values')");
}
?>