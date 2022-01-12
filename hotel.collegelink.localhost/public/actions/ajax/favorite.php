<?php

// Boot the application
require_once __DIR__. '/../../Boot/Boot.php';

use Hotel\Favorite;
use Hotel\User;

// // Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD'])!= 'post'){
    
   die;
}

   //IF THE IS ALREADY LOGGED IN USER RETURN TO HOME PAGE
if(!empty(User::getCurrentUserId())){
    die;
}

//Check if room id is given 
$roomId=$_REQUEST['room_id'];
// if (empty($roomid)){
//     header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
//     return;
// }


$favorite=new Favorite();

$isFavorite=$_REQUEST['is_favorite'];

if($isFavorite){
  $status=$favorite->removeFavorite($roomId,User::getCurrentUserId());
var_dump('remove');
}else{
     $status=$favorite->addFavorite($roomId,User::getCurrentUserId()); 
   var_dump("add to favorite");
    
}
header('Content-Type:application/json');
 echo json_encode([
    "status"=>$status,
     "is_favorite"=> !$isFavorite,
])

?>