<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select *, p.id from product as p inner join category as c on p.categoryId = c.id;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<div style="padding-top:5.5em;" align="center">
<a href="http://localhost:8888/PID_Assignment/backend/productCreate" class="create">新增</a>
<table>
    <tr>
      <th>商品名稱</th><th>類別</th><th>價格</th><th>內容</th><th>刪除</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><a href="http://localhost:8888/PID_Assignment/backend/productUpdate?productId=<?php echo $row['id'] ?>" class="update"><?php echo $row['productName'] ?></a></td>
        <td><?php echo $row['categoryName'] ?></td>
        <td><?php echo $row['price'] ?></td>
        <td><?php echo $row['description'] ?></td>
        <td><a href="http://localhost:8888/PID_Assignment/backend/productDelete?productId=<?php echo $row['id'] ?>">刪除</a></td>
      </tr>   
    <?php endwhile ?>
</table>
</div>
<?php require_once('views/store/footer.php'); ?>