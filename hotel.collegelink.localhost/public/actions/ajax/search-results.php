<?php

require __DIR__.'/../../../Boot/Boot.php';
use Hotel\Room;
use Hotel\RoomType;
use Hotel\Guests;
//initialize Room service
$room=new Room();

// Get Cities 
$cities=$room->getCities();
//Get Rooms
$type=new RoomType();
$allTypes=$type->getAlltypes();
//print_r($allTypes);

// Get Guests

$guests=new Guests();
$allguests=$guests->GuestsType();
// print_r($allguests);die;
//get page parameters

$selectedcity=$_REQUEST['city'];
$selectedtypeId=$_REQUEST['room_type'];
$checkInDate=$_REQUEST['check_in_date'];
$checkOutDate=$_REQUEST['check_out_date'];

// search for room
$availableRoom=$room->searchRoom(new DateTime($checkInDate),new DateTime($checkOutDate),$selectedcity,$selectedtypeId);

?>
        <div class="result-header"><h2>Search Results from Ajax</h2></div>
        <div class="show-result">
        <?php
          foreach($availableRoom as $room){
         ?>
         
             <div class="result-hotel">
       <div class="result-hotel-image">
         <img src='../Images/<?php echo $room['photo_url'];?>' alt="hotel-image" />
       </div>
       <div class="result-hotel-info">
         <h3><?php echo $room['name'];?></h3>
         <h4><?php echo $room['city'];?></h4>
         <p><?php echo $room['description_short'];?></p>
         <form method="get" action="../Room_Page/Page.php?">
                 <input type="hidden" name="room_id" value="<?php echo $room['room_id'];?>">
                 <input type="hidden" name="check_in_date" value="<?= $_REQUEST['check_in_date']; ?>">
                 <input type="hidden" name="check_out_date" value="<?= $_REQUEST['check_out_date']; ?>">
          <button class="link-btn page-btn" type="submit">Go to Room Page</button>
         </form>
         
       </div>
     </div>
     <div class="room-characteristics">
       <span>Per Night: <?php echo $room['price'];?></span>
       <div>
         <ul>
           <li>Count of Guests: <?php echo $room['count_of_guests'];?></li>
           <li>|</li>
           <li>Type of Room: <?php echo $room['type_id'];?></li>
         </ul>
        </div>
        </div>
            <?php  
               }
              ?>  
        </div>
        <?php if(count($availableRoom)==0)
        {?>
          <h2> There are no avaliable rooms !!!</h2>
      
       <?php
      }
      ?>

