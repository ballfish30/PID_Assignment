<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select * from user where role = "會員";
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<script src='/PID_Assignment/js/jquery.min.js'></script>
<div style="padding-top:5.5em;" align="center">
  <table>
    <tr>
      <th>編號</th><th>會員名稱</th><th>會員級別</th><th>啟用／停用</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['userName'] ?></td>
        <td><?php echo $row['role'] ?></td>
        <td><input type="checkbox" name="isActive" value=<?php echo $row['id'] ?> <?php if($row['isActive']){echo "checked";} ?>></td>
      </tr>   
    <?php endwhile ?>
  </table>
</div>
<script>
  $(document).on('change', 'input[name=isActive]', function () {
    var $this = $(this);
    $.ajax({
          type:"GET",
          url:"http://localhost:8888/PID_Assignment/backend/memberisActive?userId="+$this.val()
        })
        .done(function (data) {
          alert(data);
        })
  });
</script>
<?php require_once('views/store/footer.php'); ?>