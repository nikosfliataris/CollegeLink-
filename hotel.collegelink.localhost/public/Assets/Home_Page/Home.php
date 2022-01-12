<?php 
require __DIR__.'/../../../Boot/Boot.php';
use Hotel\Room;
use Hotel\RoomType;

//get cities
$room=new Room();
$cities=$room->getCities();
// get room
$type=new RoomType();
$allTypes=$type->getAlltypes();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Home.css" />
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <title>Hotel Project</title>
  </head>
  <body>
    
    <section class="Header-section">
      <header class="Header">
        <ul class="header-items">
          <li class="item">
            <a href="/public/Assets/List_Pages/Hotels.php">Hotels</a>
          </li>
          <li class="item"><a href="/public/Assets/Home_Page/">Home</a></li>
        </ul>
      </header>
    </section>
    <section class="Main-section">
      <img src="../Images/Burj-Al-Arab-Exterior.jpg" alt ="Burj-Al-Arab Hotel" >
      <div class="main-section-form">
        <form method="get" action="../List_Pages/Hotels.php">
          <div class="upper-group">
            <select name="city" id="City"class="form-control-cities" placeholder="City">
            <option value="">City</option>
         <?php
          foreach($cities as $city){
          ?>
            <option value="<?php echo $city; ?>"><?php echo $city; ?></option> 
            <?php  
               }
              ?>   
          </select>
            <select id="Rooms" name="room_type" class="form-control-rooms">
                        <option value="">Room Type</option>
            <?php
          foreach($allTypes as $Types){
          ?>
           
           <option value="<?php echo $Types['type_id']; ?>"><?php echo $Types['title']; ?></option> 
            <?php  
               }
              ?>   
              </select>
          </div>
          <div class="lower-group">
            <div class="check-date">
              <input type="text" id="from" name="check_in_date" placeholder="Check-In Date" />
              <input type="text" id="to" name="check_out_date" placeholder="Check-Out Date"/>
            </div>
          </div>
          <button class="search-button" type="submit">Search</button>
        </form>
      </div>
    </section>
    <section class="Footer-section">
      <p>&copy; CollegeLink <strong id="Year"></strong></p>
    </section>
    <script src="Home.js"></script>
  </body>
</html>
