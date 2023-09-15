<?php
session_start();
error_reporting(0);

class UFunction{

    private $DBHOST = 'localhost';
    private $DBUSER = 'root';
    private $DBPASS = '';
    private $DBNAME = 'login_db';
    public $conn;

    public function __construct(){
        try{
            $this->conn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
            if(!$this->conn){  
                throw new Exception('Connection was Not Extablish');
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            
        }

    }

    public function validate($string){
        $string_vali = mysqli_real_escape_string($this->conn, $string);
        return $string_vali;
    }

    public function insert($tb_name, $tb_field){
       
        $q_data = "";

        foreach($tb_field as $q_key => $q_value){
            $q_data = $q_data."$q_key='$q_value',";
        }
        $q_data = rtrim($q_data,",");

        $query = "INSERT INTO $tb_name SET $q_data";
        $insert_fire = mysqli_query($this->conn, $query);
        if($insert_fire){
            return $insert_fire;
        }
        else{
            return false;
        }

    }

  public function select_order_limit($notification, $field_name, $set_limit, $user_petnotifid, $order = "DESC") {
    $_SESSION['user_petnotifid'] = $user_petnotifid; // Store the user_petnotifid value in the session
      $select = "SELECT * FROM $notification WHERE user_petnotifid = ? ORDER BY $field_name $order LIMIT ?";
      $stmt = mysqli_prepare($this->conn, $select);
      mysqli_stmt_bind_param($stmt, "ii", $user_petnotifid, $set_limit);
      mysqli_stmt_execute($stmt);
      
      $query = mysqli_stmt_get_result($stmt);
      
      if ($query && mysqli_num_rows($query) > 0) {
          $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
          if ($select_fetch) {
              return $select_fetch;
          } else {
              return false;
          }
      } else {
          return false;
      }
  }

    //     if(mysqli_num_rows($query) > 0){
    //         $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
    //         if($select_fetch){
    //             return $select_fetch;
    //         }
    //         else{
    //             return false;
    //         }
    //     }
    //     else{
    //         return false;
    //     }

    // }




    
   
}




?>