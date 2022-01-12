<?php

namespace Hotel;

use Hotel\BaseService;
use \PDO;
use Exception;
//use DateTime;


class Room extends BaseService
{
      public function getRoom($roomId){
        $statement=$this->getPdo()->prepare('SELECT * FROM room WHERE room_id=:room_id');
        $statement->bindParam(':room_id',$roomId,PDO::PARAM_STR);
        $statement->execute();

        $room=$statement->fetchAll(PDO::FETCH_ASSOC);
   
   return $room;
    }

    public function getCities()
        {
            $cities=[];
            try{
               $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
                  foreach($rows as $row)
                   {
                       $cities[]=$row['city'];
                 }
                } catch(Exception $ex){

                    }
             return $cities;
        }

    public function searchRoom($checkInDate,$checkOutDate,$city='',$typeId='')
            {
                // Get all available room
                        $parameters=[
                        ':check_in_date'=>$checkInDate->format(\DateTime::ATOM),
                        ':check_out_date'=>$checkOutDate->format(\DateTime::ATOM),  
                         ];
                 
                         if(!empty($city)){
                             $parameters[':city']=$city;
                         }
                         if(!empty($typeId)){
                            $parameters[':type_id']=$typeId;
                        }

                        $sql='SELECT * FROM room WHERE ';
                        if (!empty($city)){
                            $sql.='city = :city AND ';
                        } 
                        if (!empty($typeId)){
                            $sql.='type_id = :type_id AND ';
                        } 
                        $sql.= 'room_id NOT IN(
                            SELECT room_id 
                            FROM booking 
                            WHERE check_in_date <= :check_out_date OR check_out_date >= :check_in_date
                            )';
               
                            return $this->fetchAll($sql,$parameters);
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
