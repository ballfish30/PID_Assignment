<?php require_once('views/store/header.php'); ?>
<div style="padding-top:5.5em;" align="center">
<form id="form1" name="form1" method="post" action="http://localhost:8888/PID_Assignment/user/login">
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
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
      <!-- <a href="http://localhost:8888/RD5_Assignment/onlineBank/restpasswd" class="restpasswd">重設密碼</a> -->
      <a href="http://localhost:8888/PID_Assignment/user/register/" class="register">註冊</a>
      </td>
    </tr>
  </table>
</form>
</div>
<?php require_once('views/store/footer.php'); ?>