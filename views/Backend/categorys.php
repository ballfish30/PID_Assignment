<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select * from category;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<div style="padding-top:5.5em;" align="center">
<table>
    <tr>
      <th>類別名稱</th><th>刪除</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo $row['categoryName'] ?></td>
        <td><a href="http://localhost:8888/PID_Assignment/backend/categoryDelete" class="cancel">刪除</a></td>
      </tr>   
    <?php endwhile ?>
</table>
</div>
<?php require_once('views/store/footer.php'); ?>