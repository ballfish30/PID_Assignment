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
      <th>商品圖</th><th>商品名稱</th><th>商品描述</th><th>數量</th><th>價格</th><th>小計</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php $orderTotal+=$row['total'] ?>
      <tr>
        <td><img style="width:200px" src="../<?php echo $row['picture'] ?>"></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['productName'] ?></td>
        <td style="vertical-align: middle;text-align: center; width:20em;"><?php echo $row['description'] ?></td>
        <td style="vertical-align: middle;text-align: center;"><input type="hidden" value="<?php echo $row['cartId'] ?>"><input type="hidden" value="<?php echo $row['id'] ?>"><input type="number" name=quantity value=<?php echo $row['quantity'] ?>></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['price'] ?></td>
        <td style="vertical-align: middle;text-align: center;"><?php echo $row['total'] ?></td>
      </tr>   
    <?php endwhile ?>
    <tr>
      <td colspan="6" style="text-align:right;">總計：<?php echo $orderTotal ?></td>
    </tr>
</table>
<a href="http://localhost:8888/PID_Assignment/store/ordercheck" class="create">結帳</a>
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
<script>
  $("input[name=quantity]").on("change", function() {
    $this = $(this);
    $quantity = $this.val();
    $productId = $this.prev().val();
    $cartId = $this.prev().prev().val();
    console.log("http://localhost:8888/PID_Assignment/store/cartUpdate?productId="+$productId + "&quantity=" + $quantity + "&cartId=" + $cartId)
    $.ajax({
      type:"GET",
      url:"http://localhost:8888/PID_Assignment/store/cartUpdate?productId="+$productId + "&quantity=" + $quantity + "&cartId=" + $cartId
    })
    .done(function (data) {
      alert(data);
      location.reload();
    })
  });
</script>
<?php require_once('footer.php'); ?>
