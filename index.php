<?php
session_start();
if(isset($_SESSION['userId'])){
  //是否有未結帳訂單，如無則新增新訂單
  $sql = <<<mutil
  select * from orders where userId = "$user[id]" and done = false;
  mutil;
  $result = mysqli_query($link, $sql);
  $order = mysqli_fetch_assoc($result);
  if ($order == Null){
    $sql = <<<mutil
      insert into orders(total, userId, done)
      values(0, "$user[id]", false)
    mutil;
    mysqli_query($link, $sql);
    $newID = mysqli_insert_id($link);
    $_SESSION['orderId'] = $newID;
  }else{
    $_SESSION['orderId'] = $order['id'];
  }
}
require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();

?>