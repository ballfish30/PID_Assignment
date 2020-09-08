<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select *, o.id from orders as o inner join user as u on o.userId = u.id where o.done = True;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<script src='/PID_Assignment/js/jquery.min.js'></script>
<div style="padding-top:5.5em;" align="center">
  <table>
    <tr>
      <th>訂單編號</th><th>會員名稱</th><th>會員級別</th><th>結帳日期</th><th>總額</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
      <td><a href="http://localhost:8888/PID_Assignment/store/order?orderId=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
        <td><?php echo $row['userName'] ?></td>
        <td><?php echo $row['role'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['total'] ?></td>
      </tr>   
    <?php endwhile ?>
  </table>
</div>
<?php require_once('views/store/footer.php'); ?>