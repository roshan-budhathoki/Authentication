<?php

require 'config.php';

session_start();

$ry = array();

$sqlConnect = $ry['sqlconnect'] = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$ry['site_url'] = $site_url;

$ry['user']['id'] = 1;

function loadPage($page_url = '')
{
    global $ry;
    $page = './ui/' . $page_url . '.phtml';
    $page_content = '';
    ob_start();
    require $page;
    $page_content = ob_get_contents();
    ob_end_clean();
    return $page_content;
}
