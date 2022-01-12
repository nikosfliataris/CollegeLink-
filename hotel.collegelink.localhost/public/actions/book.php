<?php

require_once __DIR__. '/../../Boot/Boot.php';

use Hotel\Booking;
use Hotel\User;
if (strtolower($_SERVER['REQUEST_METHOD'])!= 'post'){
    header('Location:/public/Assets/Home_Page/Home.php');
    return;
}

   //IF THE IS ALREADY LOGGED IN USER RETURN TO HOME PAGE
if(!empty(User::getCurrentUserId())){
    header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
    }
$checkIndate=$_REQUEST['check_in_date'];
$checkOutdate=$_REQUEST['check_out_date'];
$roomId=$_REQUEST['room_id'];
$booking=new Booking();
$booking->insert($roomId,User::getCurrentUserId(),$checkIndate,$checkOutdate);

 header(sprintf('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId));
 ?>