<?php

namespace Hotel;

use Hotel\BaseService;
use PDO;
use Exception;
class Reviews extends BaseService
{

    public function getByUser($userId)
    {
      $statement=$this->getPdo()->prepare('SELECT review.*,room.name FROM review INNER JOIN room ON review.room_id=room.room_id WHERE user_id=:user_id');
        $statement->bindParam(':user_id',$userId,PDO::PARAM_STR);
        $statement->execute();
        $favorite= $statement->fetchAll(PDO::FETCH_ASSOC);

        return $favorite; 
    }
    public function addReview($roomId,$userId,$rate,$comment)
     { 
       
      $this->getPdo()->beginTransaction();

      $parameters=[
        ':room_id'=>$roomId,
        ':user_id'=>$userId,
        ':rate'=>$rate,
        ':comment'=>$comment
    ];
      $this->execute('INSERT INTO review (room_id,user_id,rate,comment) VALUES (:room_id,:user_id,:rate,:comment)',$parameters);
    
      $statement=$this->getPdo()->prepare('SELECT avg(rate) as avg_reviews,count(*) as count FROM review WHERE room_id=:room_id');
      $statement->bindParam(':room_id',$roomId,PDO::PARAM_STR);
      $statement->execute();
      $roomAverage=$statement->fetchAll(PDO::FETCH_ASSOC);
     
     
    //     $parameters=[
    //     ':room_id'=>$roomId,
    //      ];
    //  $roomAverage= $this->fetchAll('SELECT avg(rate) as avg_reviews,count(*) as count FROM review WHERE room_id=:room_id',$parameters);
  //   $averageReview=[];
  
  //   foreach($roomAverage as $row)
  //   {
  //     $averageReview[]=$row['avg_reviews'];
      
  //     return $averageReview=[];
  // }

     $parameters=[
      ':room_id'=>$roomId,
      ':avg_reviews'=>$roomAverage[0]['avg_reviews'],
      ':count_reviews'=>$roomAverage[0]['count']
       ];
     $this->execute('UPDATE room SET avg_reviews=:avg_reviews,count_reviews=:count_reviews WHERE room_id=:room_id',$parameters);

    // $statement=$this->getPdo()->prepare('UPDATE room SET avg_reviews=:avg_reviews AND count_reviews=:count_reviews WHERE room_id=:room_id');
    //  $statement->bindParam(':room_id',$roomId,PDO::PARAM_STR);
    //  $statement->bindParam(':avg_reviews',$roomAverage['avg_reviews'],PDO::PARAM_STR);
    //  $statement->bindParam(':count_reviews',$roomAverage['count'],PDO::PARAM_STR);
    // $rows=$statement->execute();
     
      return $this->getPdo()->commit();
    
    }
     public function getallReviews($roomId){
            $statement=$this->getPdo()->prepare('SELECT review.*,user.name as user_name FROM review INNER jOIN user ON review.user_id=user.user_id WHERE room_id=:room_id ORDER BY created_time ASC');
            $statement->bindParam(':room_id',$roomId,PDO::PARAM_STR);
            $statement->execute();
      
              return $statement->fetchAll(PDO::FETCH_ASSOC);
             }
      
             
}
?>