<?php
   error_reporting(0);
   include('config.php');
   session_start();
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_name = $row['username'];

   if(!isset($_SESSION['login_user'])){
      session_destroy();
   }



?>