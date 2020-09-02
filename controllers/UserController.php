<?php

class UserController extends Controller
{

    function index()
    {
        $link = include 'config.php';
        $this->view("User/login");
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
      $accountName = $_POST['accountName'];
      $passwd = $_POST['passwd'];
      $link = include 'config.php';
      $sql = <<<mutil
          select * from user where accountName = "$accountName";
      mutil;
      $result = mysqli_query($link, $sql);
      $search = mysqli_fetch_assoc($result);
      echo($sql);
      if ($search == Null){
          $Message = "查無此用戶";
          return header("Location: http://localhost:8888/PID_Assignment/user/login?Message=".$Message);
      }
      elseif(!password_verify($passwd, $search['passwd'])){
          $Message = "密碼錯誤";
          return header("Location: http://localhost:8888/PID_Assignment/user/login?Message=".$Message);
      }
      $_SESSION['userId'] = $search['id'];
      $Message = "親愛的用戶$search[userName]" . "你好";
      if ($search['role'] == "管理者"){
        return $this->view("Backend/index");
      }else{
        return header("Location: http://localhost:8888/PID_Assignment/store?Message=".$Message);
      }
  }



  function logout(){
    session_start();
    session_destroy();
    $Message = "歡迎下次購物";
    return header("Location: http://localhost:8888/PID_Assignment/store?Message=".$Message);
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
      $accountName = $_POST['accountName'];
      // 資料庫連線參數
      $link = include 'config.php';
      $sql = <<<mutil
          insert into user(
            accountName, userName, passwd, role
          )
          values(
            "$accountName", "$userName",  "$passwd", "會員"
          )
      mutil;
      if (mysqli_query($link, $sql)){
          return header("Location: http://localhost:8888/PID_Assignment/store/");
      }else{
          $Message = "帳號或信箱重複";
          return header("Location: http://localhost:8888/PID_Assignment/user/register?Message=".$Message);
      }
  }



  function admin(){
    $link = include 'config.php';
    $passwd = password_hash("admin", PASSWORD_DEFAULT);
    $sql = <<<mutil
        insert into user(
          accountName, userName, passwd, role
        )
        values(
          "admin", "球魚",  "$passwd", "管理者"
        )
    mutil;
    mysqli_query($link, $sql);
    return header("Location: http://localhost:8888/PID_Assignment/store/");
  }
}
?>