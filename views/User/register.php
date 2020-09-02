<?php require_once('views/store/header.php'); ?>
<div style="padding-top:5.5em;" align="center">
<form id="form1" name="form1" method="post" action="http://localhost:8888/PID_Assignment/user/register">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td width="80" align="center" valign="baseline">帳號</td>
      <td valign="baseline"><input type="text" name="accountName" id="accountName" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">密碼</td>
      <td valign="baseline"><input type="password" name="passwd" id="passwd" required="required"/></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">用戶名</td>
      <td valign="baseline"><input type="text"" name="userName" id="userName" required="required"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="確認" />
      <a href="http://localhost:8888/PID_Assignment/store" class="cancel">取消</a>
      </td>
    </tr>
  </table>
</form>
</div>
<?php require_once('views/store/footer.php'); ?>