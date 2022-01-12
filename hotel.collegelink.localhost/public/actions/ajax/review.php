<?php

// Boot the application
require_once __DIR__. '/../../../Boot/Boot.php';

use Hotel\User;
use Hotel\Reviews;

// // Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD'])!= 'post'){
    header('Location:/public/Assets/Home_Page/Home.php');
    return;
}

   //IF THE IS ALREADY LOGGED IN USER RETURN TO HOME PAGE
if(empty(User::getCurrentUserId())){
    header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
    }

//Check if room id is given 
$roomId=$_REQUEST['room_id'];
// if (empty($roomid)){
//     header('Location:/public/Assets/Room_Page/Page.php?room_id=%s',$roomId);
//     return;
// }
$rate=$_REQUEST["rate"];
$comment=$_REQUEST["comment"];

$review=new Reviews();
$review->addReview($roomId,User::getCurrentUserId(),$rate,$comment);

print_r("room",$roomId);

$user=new User();
$userInfo=$user->getById(User::getCurrentUserId($userId));



$roomReview=new Reviews();
$counter=$roomReview->getallReviews($roomId);

?>
<div class="room-review">
        <h2>Reviews</h2>
        <?php  foreach ($userInfo as $UserInfo){
   ?>
        <small><?php echo sprintf('%d. %s', $counter, $UserInfo['name']); ?>
          <p>|</p>
          <?php for($i=1;$i<=5;$i++){
           if ($rate >=1){
             ?>
             <i class="fas fa-star checked"></i>
             <?php
            }else{
              ?>
              <i class="fas fa-star"></i>
           <?php 
           }
          }
         ?>
        </small>
       
        <small>Date:<?php echo (new DateTime())->format('Y-m-d H:i:s'); ?></small>
        <p><?php echo htmlentities($comment); ?></p>
      <?php }?>
     </div>



 
    