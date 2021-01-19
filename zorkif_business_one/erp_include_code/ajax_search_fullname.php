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

$colname_RS_GetEmpFullName = "-1";
if (isset($_POST['PINCode'])) {
  $colname_RS_GetEmpFullName = $_POST['PINCode'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetEmpFullName = sprintf("SELECT EmployeeName, PINCode FROM employeedetails WHERE PINCode = %s", GetSQLValueString($colname_RS_GetEmpFullName, "int"));
$RS_GetEmpFullName = mysql_query($query_RS_GetEmpFullName, $Conn) or die(mysql_error());
$row_RS_GetEmpFullName = mysql_fetch_assoc($RS_GetEmpFullName);
$totalRows_RS_GetEmpFullName = mysql_num_rows($RS_GetEmpFullName);
echo $row_RS_GetEmpFullName['EmployeeName'];
mysql_free_result($RS_GetEmpFullName);
?>