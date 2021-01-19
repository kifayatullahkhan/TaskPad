<?php //require_once('../../Connections/Conn.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_RsShowTaskDetails = "-1";
if (isset($_GET['TaskID'])) {
  $colname_RsShowTaskDetails = $_GET['TaskID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsShowTaskDetails = sprintf("SELECT * FROM erp_taskmanagement WHERE Task_ID = %s", GetSQLValueString($colname_RsShowTaskDetails, "int"));
$RsShowTaskDetails = mysql_query($query_RsShowTaskDetails, $Conn) or die(mysql_error());
$row_RsShowTaskDetails = mysql_fetch_assoc($RsShowTaskDetails);
$totalRows_RsShowTaskDetails = mysql_num_rows($RsShowTaskDetails);

$colname_RsGetTaskNotes = "-1";
if (isset($_GET['TaskID'])) {
  $colname_RsGetTaskNotes = $_GET['TaskID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetTaskNotes = sprintf("SELECT * FROM erp_taskmanagement_notes WHERE Task_ID = %s", GetSQLValueString($colname_RsGetTaskNotes, "int"));
$RsGetTaskNotes = mysql_query($query_RsGetTaskNotes, $Conn) or die(mysql_error());
$row_RsGetTaskNotes = mysql_fetch_assoc($RsGetTaskNotes);
$totalRows_RsGetTaskNotes = mysql_num_rows($RsGetTaskNotes);
 
?>
<div>
  <h2>تفاصيل المهمة  </h2>
  <table border="1">
    <tr class="DarkHeaderRow">
      <td>العنوان</td>
      <td>الأهمية</td>
      <td>الحالة</td>
      <td>%الانجاز</td>
      <td>تاريخ الانتهاء</td>
    </tr>
      <?php
	  $RowClass="dark";
	  $i=0;
	   do {
		   $i++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">            
        <td><?php echo $row_RsShowTaskDetails['Task_Title']; ?></td>
        <td><?php echo $row_RsShowTaskDetails['Task_Periority']; ?></td>
        <td><?php echo $row_RsShowTaskDetails['Task_Status']; ?></td>
        <td><?php echo $row_RsShowTaskDetails['Task_Completion']; ?></td>
        <td><?php echo $row_RsShowTaskDetails['Task_Complete_Date']; ?></td>
      </tr>
      <?php } while ($row_RsShowTaskDetails = mysql_fetch_assoc($RsShowTaskDetails)); ?>
  </table>
</div>
<p>&nbsp;</p>
<div>
  <table width="100%" border="1">
     <tr class="DarkHeaderRow">
      <td width="5%">#</td>
      <td width="31%">بتاريخ</td>
      <td width="64%">ملاحظات</td>
    </tr>
    <?php
	  $count=0;
	  $RowClass="light";
	  $i=0;
	   do {
		   $i++;
		   $count++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">
        <td><?php echo $count; ?></td>
        <td><?php echo $row_RsGetTaskNotes['Task_Date']; ?></td>
        <td><?php echo $row_RsGetTaskNotes['Task_Notice']; ?></td>
      </tr>
      <?php } while ($row_RsGetTaskNotes = mysql_fetch_assoc($RsGetTaskNotes)); ?>
  </table>
<p>&nbsp;</p>
</div>
<p>&nbsp;</p>
<?php
mysql_free_result($RsShowTaskDetails);

mysql_free_result($RsGetTaskNotes);

?>
