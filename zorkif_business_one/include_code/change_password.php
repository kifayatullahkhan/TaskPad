<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if (!isset($_SESSION)) {
  session_start();
}
$UserName="";
if (isset($_SESSION['MM_Username'])) {
  $UserName = $_SESSION['MM_Username'];
}
$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmPasswordChange")) {
	
	$Password_new=$_POST['Password_new'];
	$Password_old=$_POST['Password_old'];
	$Password_confirm=$_POST['Password_confirm'];
	
	
	/* 
	
	
	*/
	
	$colname_rs_get_user_password = "-1";
	if (isset($_SESSION['MM_Username'])) {
	  $colname_rs_get_user_password = $_SESSION['MM_Username'];
	}
	mysql_select_db($database_Conn, $Conn);
	$query_rs_get_user_password = sprintf("SELECT Username, Password FROM user_accounts WHERE Username = %s AND Password=%s", GetSQLValueString($colname_rs_get_user_password, "text"),GetSQLValueString($Password_old, "text"));
	$rs_get_user_password = mysql_query($query_rs_get_user_password, $Conn) or die(mysql_error());
	$row_rs_get_user_password = mysql_fetch_assoc($rs_get_user_password);
	$totalRows_rs_get_user_password = mysql_num_rows($rs_get_user_password);
	if ($totalRows_rs_get_user_password>0 && $Password_new==$Password_confirm) {		
	// -- =====================UPDATE THE PASSWORD=================================================== --
		  $updateSQL = sprintf("UPDATE user_accounts SET Password=%s WHERE Username=%s",
							   GetSQLValueString($_POST['Password_confirm'], "text"),
							   GetSQLValueString($UserName, "text"));
		
		  mysql_select_db($database_Conn, $Conn);
		  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
		  ZorkifMessageBox("Password Changed  Successfully");
	}else{
	   	  ZorkifMessageBox("Failed Attempt: Password could not be changed due to wrong old password or both new and confirm passwords does not mactches","Information");		
		}
}


?>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<br>
<h3 id="why"> تغيير كلمة المرور</h3>
<br />
<div align="center" class="DataEntryView">
  <form action="<?php echo $editFormAction."?ID=changepassword"; ?>" method="post" name="frmPasswordChange" id="frmPasswordChange">
    <table width="100%" align="center" cellpadding="5" cellspacing="5">
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">اسم المستخدم </div></td>
        <td width="25%" align="left"><strong><?php echo $UserName; ?></strong></td>
        <td width="77%" align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">كلمة المرور القديمة</div></td>
        <td width="25%" align="left"><span id="sprypassword1">
          <input name="Password_old" type="password" id="Password_old" value="" size="32" />
        <span class="passwordRequiredMsg">*</span></span></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">كلمة المرور الجديدة</div></td>
        <td width="25%" align="left"><span id="sprypassword2">
          <input name="Password_new" type="password" id="Password_new" value="" size="32" />
        <span class="passwordRequiredMsg">*</span></span></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">تأكيد كلمة المرور</div></td>
        <td width="25%" align="left"><span id="sprypassword3">
          <input name="Password_confirm" type="password" id="Password_confirm" value="" size="32" />
        <span class="passwordRequiredMsg">*</span></span></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left"></div></td>
        <td width="25%" align="left"><input type="submit" value="تغيير" />
          <input type="button" name="btnCancel" id="btnCancel" value="الغاء" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" />
          <br />
        * مطلوب </td>
        <td align="left">&nbsp;</td>
      </tr>
    </table>
    <p>
      <input type="hidden" name="MM_update" value="frmPasswordChange" />
    </p>
    <p>&nbsp;</p>
  </form>
</div>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2");
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3");
 </script>
