<?php

namespace Hotel;

use Hotel\BaseService;
use PDO;
use Exception;
//use DateTime;


class RoomType extends BaseService
{
     public function getAlltypes()
        {
           
            return $this->fetchAll('SELECT * FROM room_type');
            
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
