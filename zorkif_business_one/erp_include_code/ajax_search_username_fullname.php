<?php require_once('../../Connections/Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$colname_Rs_GetUserFullName = "-1";
if (isset($_POST['Username'])) {
  $colname_Rs_GetUserFullName = $_POST['Username'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetUserFullName = sprintf("SELECT Username, FullName FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_Rs_GetUserFullName, "text"));
$Rs_GetUserFullName = mysql_query($query_Rs_GetUserFullName, $Conn) or die(mysql_error());
$row_Rs_GetUserFullName = mysql_fetch_assoc($Rs_GetUserFullName);
$totalRows_Rs_GetUserFullName = mysql_num_rows($Rs_GetUserFullName);


echo $row_Rs_GetUserFullName['FullName'];
mysql_free_result($Rs_GetUserFullName);
?>