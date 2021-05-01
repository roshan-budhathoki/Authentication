<?php

require 'config.php';

session_start();

$ry = array();

$sqlConnect = $ry['sqlconnect'] = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$ry['site_url'] = $site_url;

$ry['loggedin'] = false;

        if(isset($_COOKIE['authenticationCartSystem']) && is_null($_COOKIE['authenticationCartSystem']) == false && $_COOKIE['authenticationCartSystem'] !== ''){

            $ry['user'] = GetUser($_COOKIE['authenticationCartSystem']);

            if($ry['user']['user_id'] > 0){

                $ry['loggedin'] = true;
            }
        
        }else{


            if(isset($_COOKIE['guestUser']) && is_null($_COOKIE['guestUser']) == false && $_COOKIE['guestUser'] !== ''){

                $ry['user']['user_id'] = $_COOKIE['guestUser'];

            }else{

                if($ry['loggedin'] == false){

                    $z = md5(rand(1,100)) ;

                    $queryy = mysqli_query($sqlConnect,"INSERT INTO guest_user(session) VALUES ('$z')");

                    setcookie("guestUser", $z, time() + (10 * 365 * 24 * 60 * 60));
                
                }

            }
           

        }


function GetUser($user_id){

    global $ry,$sqlConnect;
    $data = array();
    $query_one = "SELECT * FROM users WHERE `user_id` = {$user_id}";
    $hashed_user_Id = md5($user_id);
    $sql = mysqli_query($sqlConnect, $query_one);
    $fetched_data = mysqli_fetch_assoc($sql);

    return $fetched_data;

}

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
