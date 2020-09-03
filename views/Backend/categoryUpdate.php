<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select * from product;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<div style="padding-top:5.5em;" align="center">
</div>
<?php require_once('views/store/footer.php'); ?>