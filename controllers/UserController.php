<?php

class UserController extends Controller
{

    function index()
    {
        return $this->view("Store/index");
    }



    function login(){
      session_start();
      if($_SERVER['REQUEST_METHOD']=='GET') {
          if(isset($_GET['Message'])){
              echo $_GET['Message'];
          }
          return $this->view("User/login");
      }
      //POST
      $userName = $_POST['userName'];
      $passwd = $_POST['passwd'];
      $link = include 'config.php';
      $sql = <<<mutil
          select * from user where userName = "$userName";
      mutil;
      $result = mysqli_query($link, $sql);
      $search = mysqli_fetch_assoc($result);
      if ($search == Null){
          $Message = "查無此用戶";
          return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
      }
      elseif(!password_verify($passwd, $search['passwd'])){
          $Message = "密碼錯誤";
          return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/login?Message=".$Message);
      }
      $_SESSION['userId'] = $search['userId'];
      $Message = "親愛的用戶$userName" . "你好";
      return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/bank?Message=".$Message);
  }



  function logout(){
      session_destroy();
      $this->view("User/login");
  }



  function register(){
      if($_SERVER['REQUEST_METHOD']=='GET') {
          if(isset($_GET['Message'])){
              echo $_GET['Message'];
          }
          return $this->view("User/register");
      }
      //POST
      $userName = $_POST['userName'];
      $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
      $email = $_POST['email'];
      // 資料庫連線參數
      $link = include 'config.php';
      $sql = <<<mutil
          insert into user(
              userName, passwd, email, total
          )
          values(
              "$userName",  "$passwd", "$email", '0'
          )
      mutil;
      if (mysqli_query($link, $sql)){
          return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/");
      }else{
          $Message = "帳號或信箱重複";
          return header("Location: http://localhost:8888/RD5_Assignment/onlineBank/register?Message=".$Message);
      }
  }
}
?>