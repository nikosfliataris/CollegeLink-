<?php

namespace Hotel;

use Exception;
use Hotel\BaseService;
use PDO;

class User extends BaseService
{
    // private $pdo;

    const Tokken_key='asfdhkgjlr;ofijhgbfdklfsadf';

    private static $currentUserId;
           
    public function getById($userId){
      $statement=$this->getPdo()->prepare('SELECT * FROM user WHERE user_id=:user_id');
        $statement->bindParam(':user_id',$userId,PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }

    public function getByEmail($email){
      $statement=$this->getPdo()->prepare('SELECT * FROM user WHERE email=:email');
      $statement->bindParam(':email',$email,PDO::PARAM_STR);
      $statement->execute();
      $rows= $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
       }

    public function getList()
    {
      return $this->fetchAll('SELECT * FROM user');
       
    }

    private function fetchAll($sql,$parameters=[],$type=PDO::FETCH_ASSOC)
    {
      //prepare statement:
      $statement=$this->getPdo()->prepare($sql);
      
       //Execute
      $status=$statement->execute();
      if (!$status){
        throw new Exception($statement->errorInfo()[2]);
      }   
      
      //fetch all
      return $statement->fetchAll($type);
 
    }

     public function insert($name,$email,$password)
    { 
      //prepare statements
      $statement=$this->getPdo()->prepare('INSERT INTO user(name,email,password) VALUES (:name,:email,:password)');
      //password encode
      $passwordHash=password_hash($password,PASSWORD_BCRYPT);
      //Bind parameters
       $statement->bindParam(':name',$name,PDO::PARAM_STR);
       $statement->bindParam(':email',$email,PDO::PARAM_STR);
       $statement->bindParam(':password',$passwordHash,PDO::PARAM_STR);

       $rows=$statement->execute();
    
      return $rows==1;
    }
    public function getUserId($name,$email,$password){
      // $parameters=[
      //   ':email'=>$email,
      // ];
      // return $this->fetch('SELECT * FROM user WHERE email=:email',$parameters);
       $statement=$this->getPdo()->prepare('SELECT * FROM user WHERE name=:name,email=:email,password=:password');
       $statement->bindParam(':name',$name,PDO::PARAM_STR);
       $statement->bindParam(':email',$email,PDO::PARAM_STR);
       $statement->bindParam(':password',$password,PDO::PARAM_STR);
       $statement->execute();

       $userId=$statement->fetchAll(PDO::FETCH_ASSOC);
       
       return $userId;

  }
    public function verify($email,$password){
      //retrive user      
      $user=$this->getByEmail($email);
    
       return password_verify($password,$user['password']);
    }

    public function generateToken($userId,$csrf='')
    {
            $payload=[
         'user_id'=>$userId,
         'csrf'=>$csrf ?: md5(time()),
      ];
          $payloadEncoded=base64_encode(json_encode($payload));
          $signature=hash_hmac('sha256',$payloadEncoded,self::Tokken_key);
          
          return sprintf('%s.%s',$payloadEncoded,$signature);  
     }

  

     public function getTokenPayload($token)
     {
       [$payloadEncoded]=explode('.',$token);
       
       return json_decode(base64_decode($payloadEncoded),true);
     }   

     public function verifyToken($token)
     {
       $payload=$this->getTokenPayload($token);
       $userId=$payload['user_id'];
        $csrf=$payload['csrf'];
       return $this->generateToken($userId,$csrf)==$token;
     }
     public static function verifyCsrf($csrf)
     {
       return self::getCsrf()==$csrf;
     }

      public static function getCsrf()
     {
       $token=$_COOKIE['user_token'];
        $payload=self::getTokenPayload($token);
      
        return $payload['csrf'];
     }
     public static function getCurrentUserId()
     {
       return self::$currentUserId;
     }
     
     public static function setCurrentUserId($userId)
     {
      self::$currentUserId=$userId;
     }
}