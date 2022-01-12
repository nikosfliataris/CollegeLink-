<?php

namespace Hotel;

use Hotel\BaseService;
use Exception;
use PDO;
class Favorite extends BaseService
{

      public function getByUser($userId)
      {
        $statement=$this->getPdo()->prepare('SELECT favorite.*,room.name FROM favorite INNER JOIN room ON favorite.room_id=room.room_id WHERE user_id=:user_id');
        $statement->bindParam(':user_id',$userId,PDO::PARAM_STR);
        $statement->execute();
        $favorite= $statement->fetchAll(PDO::FETCH_ASSOC);

        return $favorite; 

      }
      public function isFavorite($roomId,$userId){
        $statement=$this->getPdo()->prepare('SELECT * FROM favorite WHERE room_id=:room_id AND user_id=:user_id');
        $statement->bindParam(':room_id',$roomId,PDO::PARAM_STR);
        $statement->bindParam(':user_id',$userId,PDO::PARAM_STR);
        $statement->execute();
        $favorite= $statement->fetchAll(PDO::FETCH_ASSOC);

        return !empty($favorite); 
        }
 
      public function addFavorite($roomId,$userId){
         $parameters=[
          ':room_id'=>$roomId,
          ':user_id'=>$userId
          ];
         print_r($parameters);
        $rows=$this->execute('INSERT IGNORE INTO favorite (room_id,user_id) VALUES (:room_id,:user_id)',$parameters);
           
        return $rows==1;        
        }

      public function removeFavorite($roomId,$userId){
        $parameters=[
          ':room_id'=>$roomId,
          ':user_id'=>$userId
          ];
          $rows = $this->execute('DELETE FROM favorite WHERE room_id=:room_id AND user_id=:user_id)',$parameters);
           return $rows==1; 
    }
   
}
