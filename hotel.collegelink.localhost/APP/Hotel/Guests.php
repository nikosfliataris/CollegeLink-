<?php
namespace Hotel;

use Hotel\BaseService;
use PDO;
use Exception;
//use DateTime;

class Guests extends BaseService
{
    public function GuestsType()
    {
       
        return $this->fetchAll('SELECT DISTINCT count_of_guests FROM room');
        
        }

        private function fetchAll($sql,$parameters=[],$type=PDO::FETCH_ASSOC)
        {
          //prepare statement:
          $statement=$this->getPdo()->prepare($sql);
          
          $status=$statement->execute($parameters);
          if (!$status){
            throw new Exception($statement->errorInfo()[2]);
          } 
          
                      //fetch all
          return $statement->fetchAll($type);
     
        }


}


?>