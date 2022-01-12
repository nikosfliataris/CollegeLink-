<?php
// Boot the application
require_once __DIR__. '/../../Boot/Boot.php';

use Hotel\User;

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD'])!= 'post'){
    header('Location:/public/Assets/Home_Page/Home.php');
    return;
}

//Create a new user
$user=new User();
$user->insert($_REQUEST['name'],$_REQUEST['email'],$_REQUEST['password']);

// Retricie user

$userInfo=$user->getByEmail($_REQUEST["email"]);
$token=$user->generateToken(($userInfo['user_id']));

// Set cokkie

setcookie('user_token',$token,time()+(30*24*60*60),'/');

//return to home page

header('Location:/public/Assets/Home_Page/Home.php');
