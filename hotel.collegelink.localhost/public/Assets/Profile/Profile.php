<?php

require __DIR__. '/../../../Boot/Boot.php'; 
use Hotel\Favorite;
use Hotel\Reviews;
use Hotel\Booking;
use Hotel\User;

$review=new Reviews();

$userId=User::getCurrentUserId($userInfo['user_id']);
if (empty($userId)){
  header('Location: /public/Assets/SignIn/SignIn.php');
 return;
}

$favorite=new Favorite();
$userFavorite=$favorite->getByUser($userId);

$review= new Reviews();
$userReview=$review->getByUser($userId);

$booking = new Booking();
$userBooking= $booking->getBooking($userId);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Profile.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <title>Profile</title>
  </head>
  <body>
    <section class="Header-section container">
      <header class="Header">
        <ul class="header-items">
          <li class="Hotels-item">
            <a href="/List_Pages/Hotels.html" class="items">Hotels</a>
          </li>
        </ul>
        <ul class="header-items">
          <li class="Home-item">
            <i class="fas fa-home"></i>
            <a href="/Home_Page/Home.html" class="items">Home</a>
          </li>
          <li class="Profile-item">
            <i class="fas fa-user"></i
            ><a href="../User-Page/Profile.html" class="items">Profile</a>
          </li>
        </ul>
      </header>
    </section>
    <section class="profile">
      <section class="Favorites-Reviews">
         <div class="favorite">
          <h2>Favorities</h2>
          <?php  if (count($userFavorite)>0){?>
        <ol> 
          <?php foreach($userFavorite as $counter=>$favorite){?>        
            <li>
            <?php echo sprintf('%d.%s',$counter+1,$reviews["user_name"]) ?>
             <a href="/public/Assets/Room_Page/Page.php?room_id=<?php echo $favorite['room_id'];?>"><?php echo $favorite ['name']?></a>
            
            <?php } ?>
          </ol>
        
         <?php } else{
          ?>          
        <?php }?>
      </div> 
        <div class="reviews">
          <h2> Reviews</h2>
          <?php if(count($userReview)>0){?>
         <ul>
         <?php foreach($userReview as $counter=>$review){?>        
            <li>
            <?php echo sprintf('%d.%s',$counter+1,$reviews["user_name"]) ?>
             <a href="/public/Assets/Room_Page/Page.php?room_id=<?php echo $review['room_id'];?>"><?php echo $review['name']?></a>
             </li>
             <?php for($i=1;$i<=5;$i++){
           if ($review["rate"] >=1){
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
        <?php } ?>
         </ul>
            <?php }else { 
              ?>
              <h4> You don't have any favorites!!!</h4>
          <?php } ?>
        </div>
        </section>
      <section class="Profile-section">
        <div class="result-header"><h2>My Bookings</h2></div>
            <?php if(count($userBooking)>0){?>
        <div class="result-hotel">
            <?php 
            foreach($userBooking as $booking){ 
             ?>
             <div class="result-hotel-image">
            <img src="../Images/room-<?php echo $booking['room_id']?>.jpg" alt="hotel-image" />
          </div>
          <div class="result-hotel-info">
            <h3><?php echo $booking['name']?></h3>
            <small><?php echo $booking['city']?></small>
            <small><?php echo $booking['area']?></small>
             <p><?php echo $booking['description_short']?></p>
            <button class="link-btn page-btn">
              <a href="/public/Assets/Room_Page/Page.php?room_id=<?php echo $booking['room_id']?>">Go to Room Page</a>
            </button>
          </div>
        </div>
          <div class="room-characteristics">
          <span>Per Night: <?php echo $booking['price']?>$</span>
          <div>
            <ul>
              <li>Check In Date: <?php echo $booking['check_in_date']?></li>
              <li>Check Out Date: <?php echo $booking['check_out_date']?></li>
              <li>Count of Guests: <?php echo $booking['count_of_guests']?></li>
              <li>Type of Room: <?php echo $booking['room_type']?></li>
            </ul>
          </div>
        </div>
        <?php } ?>
        <?php }else{?>
          <h2> You don't have any bookings</h2>
          <?php }?>
       </section>
    </section>
  </body>
</html>
