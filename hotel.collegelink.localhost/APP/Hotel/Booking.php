<?php

namespace Hotel;

use Hotel\BaseService;
use PDO;
use Exception;
use DateTime;
class Booking extends BaseService
{

      public function getBooking($userId)
      {
        $statement=$this->getPdo()->prepare('SELECT booking.*,room.*,room_type.title as room_type FROM booking INNER JOIN room ON booking.room_id=room.room_id INNER JOIN room_type ON room.type_id=room_type.type_id WHERE user_id=:user_id');
        $statement->bindParam(':user_id',$userId,PDO::PARAM_STR);
        $statement->execute();
        $favorite= $statement->fetchAll(PDO::FETCH_ASSOC);

        return $favorite; 
    }
      
      public function insert($roomId,$userId,$checkInDate,$checkOutDate)
    {
        $this->getPdo()->beginTransaction();
        $parameters=[
            'room_id'=>$roomId,
        ];
        
         $roomInfo=$this->fetchAll('SELECT * FROM room WHERE room_id=:room_id',$parameters);          
      
         $price=$roomInfo['price'];
         
         $checkInDateTime=new DateTime($checkInDate);
         print_r($checkInDateTime);
         $checkOutDateTime=new DateTime($checkOutDate);
         print_r($checkOutDateTime);
         $daysDiff=$checkOutDateTime->diff($checkInDateTime)->days;
         print_r($daysDiff);
         $totalPrice=$price*$daysDiff;        
         print_r($totalPrice);die;
         $parameters=[
            ':room_id'=>$roomId,
            ':user_id'=>$userId,
            ':total_price'=>$totalPrice,
            ':chech_in_date'=>$checkInDate,
            ':chech_out_date'=>$checkOutDate,
        ];
          $this->execute('INSERT INTO booking(room_id,user_id,total_price,check_in_date,check_out_date) VALUES (:room_id,:user_id,:total_price,:check_in_date,:check_out_date)',$parameters);
        return $this->getPdo()->commit();
        }
     public function isBooked($roomId,$checkInDate,$checkOutDate)
     { 
       $parameters=[
           'room_id'=>$roomId,
           'check_in_date'=>$checkInDate,
           'check_out_date'=>$checkOutDate
           
       ];
        $rows=$this->fetchAll('SELECT room_id FROM booking WHERE room_id=:room_id AND check_in_date <= :check_out_date AND check_out_date >= :check_in_date',$parameters);          
      
        return count($rows)>0;
    }

     private function fetchAll($sql,$parameters=[],$type=PDO::FETCH_ASSOC)
                    {
                        //prepare statement:
                         $statement=$this->getPdo()->prepare($sql);
      
                          // Bind parametes
                         $status=$statement->execute($parameters);
                          if (!$status){
                               throw new Exception($statement->errorInfo()[2]);
                                } 
                                //fetch all
                                 return $statement->fetchAll($type);
                     }
}
?>