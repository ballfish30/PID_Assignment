<?php
  $link = include 'config.php';
  $sql = <<<mutil
    select * from category;
  mutil;
  $result = mysqli_query($link, $sql);
?>
<?php require_once('header.php'); ?>
<div style="padding-top:5.5em;" align="center">
<form id="form1" name="form1" method="post" action="http://localhost:8888/PID_Assignment/backend/productCreate" enctype="multipart/form-data">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td width="80" align="center" valign="baseline">商品名稱</td>
      <td valign="baseline"><input type="text" name="productName" id="productName" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">商品類別</td>
      <td valign="baseline">
        <select name="categoryId">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['categoryName'] ?></option>
        <?php endwhile ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">商品價格</td>
      <td valign="baseline"><input type="number" name="productPrice" id="productPrice" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">商品內容</td>
      <td valign="baseline"><textarea rows="4" cols="50" name="productDescription"></textarea></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">圖片</td>
      <td valign="baseline">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <div class="c-zt-pic">
          <img id="preview" src="">
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="確認" />
      <a href="http://localhost:8888/PID_Assignment/backend/categorys" class="cancel">取消</a>
      </td>
    </tr>
  </table>
</form>
</div>
<script>
  $('#fileToUpload').change(function() {
    var f = document.getElementById('fileToUpload').files[0];
    var src = window.URL.createObjectURL(f);
    document.getElementById('preview').src = src;
  });
</script>
<?php require_once('views/store/footer.php'); ?>