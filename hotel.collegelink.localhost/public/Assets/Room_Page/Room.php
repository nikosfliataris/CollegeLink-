<?php
require __DIR__. '/../../../Boot/Boot.php'; 

// header("Access-Control-Allow-Origin:* || //Https://www.collegelink.gr//");

use Hotel\Room;
use Hotel\Favorite;
use Hotel\User;
use Hotel\Reviews;
use Hotel\Booking;
$room=new Room();
$favorite=new Favorite();
$review=new Reviews();


$roomId=$_REQUEST['room_id'];
// if (empty($roomId)){
//   header('Location: /public/Assets/List_Pages/Hotels.php');
//   die;
// }


$roomInfo =$room->getRoom($roomId);
// if (empty($roomInfo)){
//   header('Location: /public/Assets/List_Pages/Hotels.php');
//   die;
// }

$userId=User::getCurrentUserId($userInfo['user_id']);


$myFavorite=$favorite->isFavorite($roomId,$userId);

$allReviews=$review->getallReviews($roomId);

$checkInDate=$_REQUEST['check_in_date'];
$checkOutDate=$_REQUEST['check_out_date'];



$allreadyBooked= empty($checkIndate)||empty($checkOutdate);

if(!$alreadyBooked){
  // look for bookings
  $booking = new Booking();
  $alreadyBooked = $booking->isBooked($roomId,$checkInDate,$checkOutDate);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Page.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  
    <title>Detail Page</title>
  </head>
  <body>
    <section class="Header-section container">
      <header class="Header">
        <ul class="header-items">
          <li class="Hotels-item">
            <a href="/public/Assets/List_Pages/Hotels.php" class="items">Hotels</a>
          </li>
        </ul>
        <ul class="header-items">
          <li class="Home-item">
            <i class="fas fa-home"></i>
            <a href="/public/Assets/Home_Page/" class="items">Home</a>
          </li>
          <li class="Profile-item">
            <i class="fas fa-user"></i
            ><a href="/public/Assets/Profile/Profile.php" class="items"
              >Profile</a
            >
          </li>
        </ul>
      </header>
    </section>
    <section class="Main-container">
      <div class="room-info">
        <h3>
        <?php
        foreach ($roomInfo as $info){
         echo sprintf('%s - %s,%s',$info['name'],$info['city'],$info['area']);
         ?>
         </h3>
         
          <span>Reviews:</span>
          <span class="review-stars">
          <?php  $average=$info['avg_reviews'];
               for( $i=1; $i<=5; $i++){
                 if($average>=$i){
                    ?><i class="fas fa-star review-star"></i>
                    <?php 
                    
                 }else{
                   ?>
                     <i class="fa fa-star"></i>
                 <?php
                    }
               }

          ?>       
          <form name="favorite" method="post" id="favoriteForm" class="favoriteForm" action="/public/actions/favorite.php">
              <input type="hidden" name="room_id" value="<?php echo $info['room_id']?>">
              <input type="hidden" name="is_favorite" value="<?php echo $myFavorite? '1':'0'; ?>">
              <button class="favorite-button"type="submit"><i class="fas fa-heart <?php echo $myFavorite ? "selected":"";?>"></i></button>
          </form>
         </span>
        <span> Per Night: <?php echo $info['price'] ?>$</span>
      </div>
      <div class="room-image">
        <img src="/public/Assets/Images/<?php echo $info['photo_url'] ?> " />
      </div>
      <div class="room-details">
        <ul>
          <li>
            <i class="fas fa-user"> <?php echo $info['count_of_guests'] ?></i>
            Count of Guest
          </li>
          <p>|</p>
          <li>
            <i class="fas fa-bed"> <?php echo $info['type_id'] ?></i>
            Type of Room
          </li>
          <p>|</p>
          <li>
            <i class="fas fa-parking"> <?php echo $info['parking'] ?></i>
            Parking
          </li>
          <p>|</p>
          <li>
            <i class="fas fa-wifi"> <?php echo $info['wifi'] ?></i>
            Wi-fi
          </li>
          <p>|</p>
          <li>
            <i class="fas fa-dog"></i>
              
          </li>
        </ul>
      </div>
      <div class="room-description">
        <div class="room-description-infos">
          <h2>Room Description</h2>
          <p>
          <?php echo $info['description_long'] ?>
          </p>
          </div>
      </div>
      <?php if($alreadyBooked){ ?>
        <button  class="book-btn" disabled>ALL READY BOOKED</button>
        <?php 
         }else{
         ?>
           <form name="bookingForm" method="post" action="/public/actions/book.php">
              <input type="hidden" name="room_id" value="<?php echo $info['room_id'];?>">
              <input type="hidden" name="check_in_date" value="<?php echo $checkIndate;?>">
              <input type="hidden" name="check_out_date" value="<?php echo $checkOutdate;?>">
              <button type="submit" class="book-btn">Book</button>
            </form >
        <?php 
           }
          ?>
      <div class="room-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12580.16305347882!2d23.7353123!3d37.976178!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb126665c4705d54b!2sHotel%20Grande%20Bretagne%2C%20a%20Luxury%20Collection%20Hotel%2C%20Athens!5e0!3m2!1sel!2sgr!4v1636639298907!5m2!1sel!2sgr"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
        ></iframe>
      </div>
      <?php }?>
    </section>
    <section class="Room-reviews">
    <?php foreach($allReviews as $counter=> $reviews){
      ?>    
    <div class="room-review">
        <h2>Reviews</h2>
        <small><?php echo sprintf('%d.%s',$counter+1,$reviews["user_name"]) ?>
          <p>|</p>
          <?php for($i=1;$i<=5;$i++){
           if ($reviews["rate"] >=$i){
             ?>
             <i class="fas fa-star review-star"></i>
                    <?php 
                    
                 }else{
                   ?>
                     <i class="fa fa-star"></i>
                 <?php
                    }
               }
         ?>
        </small>
       
        <small>Date: <?php echo $reviews["created_time"]?></small>
        <p><?php echo $reviews["comment"]?></p>
      </div>
       <?php 
      }
      ?>
    </section>
    <section class="add-review">
      <div class="review">
        <h4>Add Review</h4>
        <form method="post" name="review" class="review" action="/public/actions/reviews.php" name="reviewform">
         <input type="hidden" name="room_id" value="<?php echo $roomId?>">
         
         <div class="rate">
           <input type="radio" id="star5" name="rate" value="5" />
           <label for="star5" title="text">5 stars</label>
           <input type="radio" id="star4" name="rate" value="4" />
           <label for="star4" title="text">4 stars</label>
           <input type="radio" id="star3" name="rate" value="3" />
           <label for="star3" title="text">3 stars</label>
           <input type="radio" id="star2" name="rate" value="2" />
           <label for="star2" title="text">2 stars</label>
           <input type="radio" id="star1" name="rate" value="1" />
           <label for="star1" title="text">1 star</label>
        </div>
        <textarea name="comment" placeholder="Review.........."></textarea>
        <button class="review-btn" type="submit">Submit Review</button>
        </form>
      </div>
     </section>
    
    <script src="Page.js"></script>
  </body>
</html>
