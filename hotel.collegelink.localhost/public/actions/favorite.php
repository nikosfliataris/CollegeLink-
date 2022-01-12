<?php

// Boot the application
require_once __DIR__. '/../../Boot/Boot.php';

use Hotel\Favorite;
use Hotel\User;

// // Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD'])!= 'post'){
    header('Location:/public/Assets/Home_Page/Home.php');
    return;
}

   //IF THE IS ALREADY LOGGED IN USER RETURN TO HOME PAGE
if(!empty(User::getCurrentUserId())){
    header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
    }

//Check if room id is given 
$roomId=$_REQUEST['room_id'];
// if (empty($roomid)){
//     header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
//     return;
// }


$favorite=new Favorite();

$isFavorite=$_REQUEST['is_favorite'];

if(!$isFavorite){
   $favorite->addFavorite($roomId,User::getCurrentUserId()); 
   var_dump("add to favorite");
}else{
    $favorite->removeFavorite($roomId,User::getCurrentUserId());
var_dump('remove');
}
header(sprintf('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId));


?>