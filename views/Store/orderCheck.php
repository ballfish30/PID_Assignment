<?php
session_start();
$orderTotal;
$link = include 'config.php';
$sql = <<<mutil
  select * from orders as o inner join cart as c on o.id = c.orderId and o.id = $_SESSION[orderId];
mutil;
$result = mysqli_query($link, $sql);
$order = mysqli_fetch_assoc($result);
$sql = <<<mutil
    select *, c.id cartId from cart as c inner join product as p on c.productId = p.id and c.orderId = $_SESSION[orderId];
  mutil;
$result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<script src='/PID_Assignment/js/jquery.min.js'></script>
<div style="padding-top:10em;" align="center">
<table>
    <tr>
      <th>商品圖</th><th>商品名稱</th><th>商品名稱</th><th>數量</th><th>價格</th><th>小計</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php $orderTotal+=$row['total'] ?>
      <tr>
        <td><img style="width:200px" src="../<?php echo $row['picture'] ?>"></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['productName'] ?></td>
        <td style="vertical-align: middle;text-align: center; width:20em;"><?php echo $row['description'] ?></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['quantity'] ?></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['price'] ?></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['total'] ?></td>
      </tr>   
    <?php endwhile ?>
    <tr>
      <td colspan="6" style="text-align:right;">總計：<?php echo $orderTotal ?></td>
    </tr>
</table>
<br><br><br>
<form id="form1" name="form1" method="post" action="http://localhost:8888/PID_Assignment/store/pay">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td width="100" align="center" valign="baseline">收件人姓名：</td>
      <td valign="baseline"><input type="text" name="name" id="name" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">收件人信箱：</td>
      <td valign="baseline"><input type="email" name="email" id="email" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">收件人地址：</td>
      <td valign="baseline"><input type="text"" name="address" id="address" required="required"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="確認訂單" />
      </td>
    </tr>
  </table>
</form>
<p>測試卡號：4311-9522-2222-2222 </p>
<p>安全密碼：２２２</p>
<p>有效日期：今日之後即可</p>
</div>
<?php
  $sql = <<<mutil
    update orders
      set
        total = $orderTotal
      where
        id = $_SESSION[orderId]
  mutil;
  mysqli_query($link, $sql);
?>
<?php require_once('footer.php'); ?>
