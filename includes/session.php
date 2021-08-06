<?php
    
class Session{
   
   private $logged_in = FALSE;
   public $user_id;
   public $department;
   public $message;
        
   function __construct(){
       session_start();
       $this->check_message();
       $this->check_login();
   }

   public function is_logged_in(){
       return $this->logged_in;
   }

   public function login($user){
       if($user) {
           $this->user_id = $_SESSION['user_id'] = $user->id;
           $this->department = $_SESSION['department'] = $user->department;
           $this->logged_in = TRUE;
       }
   }

   public function logout(){
       unset($_SESSION['user_id']);
       unset($this->user_id);
       $this->logged_in = FALSE;
   }

   public function message($msg=""){
       if(!empty($msg)){
           // then this is a "set message"
           $_SESSION['message'] = $msg;
       } else {
           // then this is a "get message"
           return $this->message;
       }
   }

   private function check_login(){
       if (isset($_SESSION['user_id'])){
           $this->user_id = $_SESSION['user_id'];
           $this->logged_in = TRUE;
       } else {
           unset($this->user_id);
           $this->logged_in = FALSE;
       }
   }

   private function check_message(){
       if (isset($_SESSION['message'])){
           $this->message = $_SESSION['message'];
           unset($_SESSION['message']);
       } else {
           $this->message = "";
       }
   }



}

$session = new Session();
$message = $session->message();

?>


