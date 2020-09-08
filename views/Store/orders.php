<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select * from orders where userId = $_SESSION[userId] and done = True;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<div style="padding-top:8em;" align="center">
  <table>
    <tr>
      <th>編號</th><th>日期</th><th>總額</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><a href="http://localhost:8888/PID_Assignment/store/order?orderId=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
      <td><?php echo $row['date'] ?></td>
      <td><?php echo $row['total'] ?></td>
    </tr>
    <?php endwhile ?>
  </table>
</div>
<?php require_once('footer.php'); ?>