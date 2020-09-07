<?php
session_start();
if(isset($_SESSION['userId'])){
  $link = include 'config.php';
  //是否有未結帳訂單，如無則新增新訂單
  $sql = <<<mutil
  select * from orders where userId = "$_SESSION[userId]" and done = false;
  mutil;
  $result = mysqli_query($link, $sql);
  $order = mysqli_fetch_assoc($result);
  if ($order == Null){
    $sql = <<<mutil
      insert into orders(total, userId, done)
      values(0, "$_SESSION[userId]", false);
    mutil;
    $result = mysqli_query($link, $sql);
    $order = mysqli_fetch_assoc($result);
    $_SESSION['orderId'] = $order['id'];
  }else{
    $_SESSION['orderId'] = $order['id'];
  }
}
require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();

?>