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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Hotels.css" />
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <title>Hotels</title>
  </head>
  <body>
    <section class="Header-section container">
      <header class="Header">
        <ul class="header-items">
          <li class="Hotels-item">
            <a href="../List_Pages/Hotels.php" class="items">Hotels</a>
          </li>
        </ul>
        <ul class="header-items">
          <li class="Home-item">
            <i class="fas fa-home"></i>
            <a href="../Home_Page/Home.php" class="items">Home</a>
          </li>
          <li class="Profile-item">
            <i class="fas fa-user"></i
            ><a href="../Profile/Profile.php" class="items">Profile</a>
          </li>
        </ul>
      </header>
    </section>
    <div class="container">
      <section class="search-bar" id="search-bar">
        <div class="search-container">
          <span><h3>FIND THE PERFECT HOTEL</h3></span>
          <div class="search-properties">
            <form class='searchForm'method="get" action="/public/Assets/List_Pages/Hotels.php">
              <div class="search-properties-upper-group search-group">
                <select id="Guests" name="guests" class="form-control-Guests">
                <option value=""> Guests</option>
                <?php
                
                foreach($allguests as $guests){
          ?>
            <option value="<?php echo $guests['count_of_guests']; ?>"><?php echo $guests['count_of_guests']; ?></option> 
            <?php  
               }
              ?>
                </select>
                <select id="City" name="city" class="form-control-cities">
                <option value=""> City</option>
                <?php
          foreach($cities as $city){
          ?>
            <option <?php echo $selectedcity==$city ? 'selected="selected"':'';?> value="<?php echo $city; ?>"><?php echo $city; ?></option> 
            <?php  
               }
              ?> </select>

                <select id="Rooms" name="room_type" class="form-control-rooms">
                <option value=""> Room Type</option>
               <?php
          foreach($allTypes as $type){
          ?>
            <option <?php echo $selectedtypeId==$type['type_id']? 'selected="selected"':'';?> value="<?php echo $type['type_id']; ?>"><?php echo $type['title']; ?></option> 
            <?php  
               }
              ?>
                </select>
              </div>
              <div class="search-properties-middle-group search-group">
                <div class="range-slider">
                  <p>
                    <label for="amount"></label>
                    <input
                      type="text"
                      id="amount1"
                      value="$0"
                    />
                    <input
                      type="text"
                      id="amount2"
                      value="$1500"
                    />
                  </p>
                </div>
                <div id="slider-range"></div>
                <span class="price-range">
                  <p>PRICE MIN</p>
                  <p>PRICE MAX</p>
                </span>
              </div>
              <div class="search-properties-lower-group search-group">
                <div class="check-date">
                  <input
                    type="text"
                    id="from"
                    name="from"
                    placeholder="Check-In Date"
                    value="<?php echo $checkInDate?>"
                  />
                  <input
                    type="text"
                    id="to"
                    name="to"
                    placeholder="Check-Out Date"
                    value="<?php echo $checkOutDate?>"
                  />
                </div>
              </div>
              <button class="search-button">Find Hotel</button>
            </form>
          </div>
        </div>
      </section>
      <section class="result-bar">
        <div class="result-header"><h2>Search Results</h2></div>
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
         <form method="get" class="form-page-btn"action="../Room_Page/Page.php?">
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
          </section>
      
    </div>
    <script src="Hotels.js"></script>
  </body>
</html>
