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
$StatusMessage=""; // This varible will hold the message which will be displayed to the User according to his actions , Update, delte save etc.

$UserName="";
if (isset($_SESSION['MM_Username']) && isset($_POST['Username'])) {
 // $UserName = $_SESSION['MM_Username'];
 $UserName =$_POST['Username'];
}
$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmPasswordChange")) {
	
	$Password_new=$_POST['Password_new'];
	
	
	/* 
	
	
	*/
	
	$colname_rs_get_user_password = "-1";
	if (isset($_SESSION['MM_Username'])) {
	  $colname_rs_get_user_password = $_SESSION['MM_Username'];
	}
	mysql_select_db($database_Conn, $Conn);
	$query_rs_get_user_password = sprintf("SELECT Username, Password FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_rs_get_user_password, "text"));
	$rs_get_user_password = mysql_query($query_rs_get_user_password, $Conn) or die(mysql_error());
	$row_rs_get_user_password = mysql_fetch_assoc($rs_get_user_password);
	$totalRows_rs_get_user_password = mysql_num_rows($rs_get_user_password);
	if ($totalRows_rs_get_user_password>0) {		
	// -- =====================UPDATE THE PASSWORD=================================================== --
		  $updateSQL = sprintf("UPDATE user_accounts SET Password=%s WHERE Username=%s",
							   GetSQLValueString($Password_new, "text"),
							   GetSQLValueString($UserName, "text"));
		
		  mysql_select_db($database_Conn, $Conn);
		  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
		  ZorkifMessageBox("Password Changed  Successfully");
	}else{
	   	  ZorkifMessageBox("Failed Attempt: Password could not be changed due to wrong old password or both new and confirm passwords does not mactches");		
		}
}



$currentPage = $_SERVER["PHP_SELF"];

$SearchText="";
if(isset($_POST['SearchText']) && $_POST['SearchText']!="") {
   $SearchText=" WHERE Username='" .$_POST['SearchText']  ."'";
}else	
	if(isset($_GET['SearchText']) && $_GET['SearchText']!="") {
	   $SearchText=" WHERE Username='" .$_GET['SearchText']  ."'";
	}

$maxRows_rs_get_user_accounts = 10;
$pageNum_rs_get_user_accounts = 0;
if (isset($_GET['pageNum_rs_get_user_accounts'])) {
  $pageNum_rs_get_user_accounts = $_GET['pageNum_rs_get_user_accounts'];
}
$startRow_rs_get_user_accounts = $pageNum_rs_get_user_accounts * $maxRows_rs_get_user_accounts;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_user_accounts = "SELECT * FROM user_accounts  $SearchText ORDER BY Username ASC";
$query_limit_rs_get_user_accounts = sprintf("%s LIMIT %d, %d", $query_rs_get_user_accounts, $startRow_rs_get_user_accounts, $maxRows_rs_get_user_accounts);
$rs_get_user_accounts = mysql_query($query_limit_rs_get_user_accounts, $Conn) or die(mysql_error());
$row_rs_get_user_accounts = mysql_fetch_assoc($rs_get_user_accounts);

if (isset($_GET['totalRows_rs_get_user_accounts'])) {
  $totalRows_rs_get_user_accounts = $_GET['totalRows_rs_get_user_accounts'];
} else {
  $all_rs_get_user_accounts = mysql_query($query_rs_get_user_accounts);
  $totalRows_rs_get_user_accounts = mysql_num_rows($all_rs_get_user_accounts);
}
$totalPages_rs_get_user_accounts = ceil($totalRows_rs_get_user_accounts/$maxRows_rs_get_user_accounts)-1;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_groups = "SELECT * FROM user_groups ORDER BY GroupName ASC";
$rs_get_groups = mysql_query($query_rs_get_groups, $Conn) or die(mysql_error());
$row_rs_get_groups = mysql_fetch_assoc($rs_get_groups);
$totalRows_rs_get_groups = mysql_num_rows($rs_get_groups);

$queryString_rs_get_user_accounts = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_get_user_accounts") == false && 
        stristr($param, "totalRows_rs_get_user_accounts") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_get_user_accounts = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_get_user_accounts = sprintf("&totalRows_rs_get_user_accounts=%d%s", $totalRows_rs_get_user_accounts, $queryString_rs_get_user_accounts);
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<h3 id="why">تغيير كلمة المرور للمستخدمين</h3>
<br />
<div align="center"  class="DataEntryView">
  <form action="<?php echo $editFormAction."?ID=changeuserpassword"; ?>" method="post" name="frmPasswordChange" id="frmPasswordChange">
    <table width="100%" align="center" cellpadding="5" cellspacing="5">
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">اسم المستخدم :</div></td>
        <td width="25%" align="left"><span id="sprytextfield1">
          <input name="Username" type="text" id="Username" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td width="77%" align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap"><div align="left">كلمة المرور الجديدة :</div></td>
        <td width="25%" align="left"><span id="sprytextfield2">
          <input name="Password_new" type="password" id="Password_new" value="" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" align="right" nowrap="nowrap">&nbsp;</td>
        <td width="25%"><input type="submit" value="تغيير" />
        <input type="button" name="btnCancel" id="btnCancel" value="الغاء" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="frmPasswordChange" />
  </form>
</div><br />

<div id="searchBox">
  <form id="frmSearch" name="frmSearch" method="post" action="<?php echo $currentPage; ?>">
    <label for="SearchText">اكتب اسم المستخدم هنا للبحث</label>
    <input type="text" name="SearchText" id="SearchText" />
    <input type="submit" name="button" id="button" value="بحث" />
    (اترك المربع فارغا لاظهار جميع النتائج)
  </form>
</div>

<br />
اضغط على اسم المستخدم ل &quot;<strong><i>تغيير كلمة المرور</i></strong>&quot;.<br />
<div class="DetailView">
  <table width="643" border="0" cellpadding="5" cellspacing="5" >
    <tr  class="DarkHeaderRow"  >
      
      <th width="14%">اسم المستخدم</th>
      <th width="14%">كلمة المرور</th>
      <th width="14%">الاسم كامل</th>
      <th width="12%">المدينة</th>
      <th width="12%">الايميل</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="javascript:" onClick="document.forms.frmPasswordChange.elements['Username'].value='<?php echo $row_rs_get_user_accounts['Username']; ?>'"><?php echo $row_rs_get_user_accounts['Username']; ?></a></td>
        <td><?php echo $row_rs_get_user_accounts['Password']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['FullName']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['City']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['Email']; ?></td>
      </tr>
      <?php } while ($row_rs_get_user_accounts = mysql_fetch_assoc($rs_get_user_accounts)); ?>
    </table>
</div>
<?php
 if ($totalPages_rs_get_user_accounts>0){
?>
<div align="center">
<table border="0">
  <tr>
    <td><?php if ($pageNum_rs_get_user_accounts > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, 0, $queryString_rs_get_user_accounts); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, max(0, $pageNum_rs_get_user_accounts - 1), $queryString_rs_get_user_accounts); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts < $totalPages_rs_get_user_accounts) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, min($totalPages_rs_get_user_accounts, $pageNum_rs_get_user_accounts + 1), $queryString_rs_get_user_accounts); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts < $totalPages_rs_get_user_accounts) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, $totalPages_rs_get_user_accounts, $queryString_rs_get_user_accounts); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>

</div>
<?php
 }
?>



<?php

mysql_free_result($rs_get_user_accounts);

?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
