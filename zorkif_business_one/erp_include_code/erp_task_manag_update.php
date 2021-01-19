<?php //require_once('../../Connections/Conn.php'); ?>
<?php
if (!isset($_SESSION)) {
session_start();	
}
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

//  Choosing Different Update Query Based on Your Selection

  		   
	if($_POST['Task_Completion']=="100" || $_POST['Task_Status']=="Completed" ){
		// Complete the Task and Close it.
		  $updateSQL = sprintf("UPDATE erp_taskmanagement SET  Task_Status=%s, Task_Completion=%s, Task_Complete_Date=%s WHERE Task_ID=%s",
		 				   GetSQLValueString($_POST['Task_Status'], "text"),
						   GetSQLValueString(100, "int"),
						   GetSQLValueString(date("Y-m-d H:i:s"), "date"),
						   GetSQLValueString($_POST['Task_ID'], "int"));
	}else{
		// Only Update the Status and Percentage of the Task
	  $updateSQL = sprintf("UPDATE erp_taskmanagement SET  Task_Status=%s, Task_Completion=%s WHERE Task_ID=%s",
						   GetSQLValueString($_POST['Task_Status'], "text"),
						   GetSQLValueString((int)$_POST['Task_Completion'], "int"),
						   GetSQLValueString($_POST['Task_ID'], "int"));	
	}
  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

$maxRows_Rs_Show_Tasks = 10;
$pageNum_Rs_Show_Tasks = 0;
if (isset($_GET['pageNum_Rs_Show_Tasks'])) {
  $pageNum_Rs_Show_Tasks = $_GET['pageNum_Rs_Show_Tasks'];
}
$startRow_Rs_Show_Tasks = $pageNum_Rs_Show_Tasks * $maxRows_Rs_Show_Tasks;

mysql_select_db($database_Conn, $Conn);
/* Setting for Searching a Record Based on a Name or Description */
	$SearchText="";
	$SearchByFieldName="Task_Title";
	if (isset($_POST['SearchText']) && $_POST['SearchText']!="Search Record…") {
	 $SearchText=" WHERE ".$SearchByFieldName ." LIKE '".$_POST['SearchText']."%' OR  Task_Title LIKE '%". $_POST['SearchText']	."%'";
//$SearchText=$SearchByFieldName ." LIKE %".$_POST['SeaarchText']."%";
}
/*=============================================== */

if(!isset($_POST['SearchText'])){
	if ($_SESSION['MM_UserGroup']==1){
		$query_Rs_Show_Tasks = "SELECT * FROM erp_taskmanagement ORDER by Task_ID DESC";
	}else{
		$query_Rs_Show_Tasks = "SELECT * FROM erp_taskmanagement WHERE Task_Username='". $_SESSION['MM_Username']."'";
	}// end of else
}
else {
$query_Rs_Show_Tasks = "SELECT * FROM erp_taskmanagement $SearchText AND Task_Username='". $_SESSION['MM_Username']."'";
}


$query_limit_Rs_Show_Tasks = sprintf("%s LIMIT %d, %d", $query_Rs_Show_Tasks, $startRow_Rs_Show_Tasks, $maxRows_Rs_Show_Tasks);
$Rs_Show_Tasks = mysql_query($query_limit_Rs_Show_Tasks, $Conn) or die(mysql_error());
$row_Rs_Show_Tasks = mysql_fetch_assoc($Rs_Show_Tasks);

if (isset($_GET['totalRows_Rs_Show_Tasks'])) {
  $totalRows_Rs_Show_Tasks = $_GET['totalRows_Rs_Show_Tasks'];
} else {
  $all_Rs_Show_Tasks = mysql_query($query_Rs_Show_Tasks);
  $totalRows_Rs_Show_Tasks = mysql_num_rows($all_Rs_Show_Tasks);
}
$totalPages_Rs_Show_Tasks = ceil($totalRows_Rs_Show_Tasks/$maxRows_Rs_Show_Tasks)-1;

$colname_Rs_Record_For_Edit = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_Record_For_Edit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_Record_For_Edit = sprintf("SELECT * FROM erp_taskmanagement WHERE Task_ID = %s", GetSQLValueString($colname_Rs_Record_For_Edit, "int"));
$Rs_Record_For_Edit = mysql_query($query_Rs_Record_For_Edit, $Conn) or die(mysql_error());
$row_Rs_Record_For_Edit = mysql_fetch_assoc($Rs_Record_For_Edit);
$totalRows_Rs_Record_For_Edit = mysql_num_rows($Rs_Record_For_Edit);
?>
<p>&nbsp;</p>
<div>
  <h2>عرض جميع المهام</h2>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr class="DarkHeaderRow">
    
    <td colspan="3">الاجراء</td>
      <td>اسم المستخدم</td>
      <td>عنوان المهمة</td>
      <td>الأهمية</td>
      <td>الحالة</td>
      <td>%الانجاز</td>      
      <td>تاريخ البدء</td>
      <td>تاريخ الانتهاء</td>
    </tr>
    
      <?php
	  $RowClass="light";
	  $i=0;
	   do {
		   $i++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">
      
        <td><a href="erp_task_details.php?TaskID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">عرض</a></td>
        <td><a href="?EditID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">تحديث</a></td>
        <td><a href="erp_task_notes.php?TaskID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">ملاحظات</a></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Username']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Title']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Periority']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Status']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Completion']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['CreatedAt']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Complete_Date']; ?></td>
      </tr>
      <?php } while ($row_Rs_Show_Tasks = mysql_fetch_assoc($Rs_Show_Tasks)); ?>
  </table>
  <?php if ($totalRows_Rs_Record_For_Edit > 0) { // Show if recordset not empty ?>
  <div>
    <h2>تحديث المهمة</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="100%" align="center" cellpadding="5" cellspacing="5">
        <tr>
          <td colspan="3"><strong>العنوان:</strong><?php echo $row_Rs_Record_For_Edit['Task_Title']; ?></td>
        </tr>
        <tr valign="baseline">
          <td width="216"><strong>الحالة :
            <select name="Task_Status" id="Task_Status">
              <option value="Not Started" <?php if (!(strcmp("Not Started", $row_Rs_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>لم تبدأ</option>
              <option value="Deferred" <?php if (!(strcmp("Deferred", $row_Rs_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>مؤجلة</option>
              <option value="In Progress" <?php if (!(strcmp("In Progress", $row_Rs_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>يتم العمل عليها</option>
              <option value="Waiting on someone else" <?php if (!(strcmp("Waiting on someone else", $row_Rs_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>معتمده على شخص اخر</option>
              <option value="Completed" <?php if (!(strcmp("Completed", $row_Rs_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>تمت</option>
              </select>
            </strong></td>
          <td width="160"><strong>نسبة الاكتمال %
            <select  name="Task_Completion" id="Task_Completion" >
              <?php 
			  
			  for($i=0;$i<=100;$i++){
				   $selected="";
				  if (!(strcmp($i, $row_Rs_Record_For_Edit['Task_Completion']))) {
					  $selected= "selected=\"selected\"";
					 }else
					  $selected="";
			  echo "<option value=\"$i\" $selected >$i</option>";
			  }
              ?>
              </select>
            <?php  ?>
            </strong></td>
          <td width="397"><input name="button" type="submit" id="button" value="تحديث المهمة" /></td>
        </tr>
        </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="Task_ID" value="<?php echo $row_Rs_Record_For_Edit['Task_ID']; ?>" />
      </form>
  </div>
  <?php } // Show if recordset not empty ?>
</div>

<div><!-- Completed Tasks List -->
<?php
 $query_Rs_Show_Tasks = "SELECT * FROM erp_taskmanagement WHERE Task_Username='". $_SESSION['MM_Username']."' AND (Task_Completion=100 || Task_Status='Completed')";
 

 
$Rs_Show_Tasks = mysql_query($query_Rs_Show_Tasks, $Conn) or die(mysql_error());
$row_Rs_Show_Tasks = mysql_fetch_assoc($Rs_Show_Tasks);

?>
 <h2>مهام مكتملة</h2>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr class="DarkHeaderRow">
    
    <td colspan="3">الاجراء</td>
      <td>اسم المستخدم</td>
      <td>عنوان المهمة</td>
      <td>الأهمية</td>
      <td>الحالة</td>
      <td>%الانجاز</td>      
      <td>تاريخ البدء</td>
      <td>تاريخ الانتهاء</td>
    </tr>
    
        <?php
	  $RowClass="light";
	  $i=0;
	   do {
		   $i++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">
      
        <td><a href="erp_task_details.php?TaskID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">عرض</a></td>
        <td><a href="?EditID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">تحديث</a></td>
        <td><a href="erp_task_notes.php?TaskID=<?php echo $row_Rs_Show_Tasks['Task_ID']; ?>">ملاحظات</a></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Username']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Title']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Periority']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Status']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Completion']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['CreatedAt']; ?></td>
        <td><?php echo $row_Rs_Show_Tasks['Task_Complete_Date']; ?></td>
      </tr>
      <?php } while ($row_Rs_Show_Tasks = mysql_fetch_assoc($Rs_Show_Tasks)); ?>
  </table>

</div>
<?php
mysql_free_result($Rs_Show_Tasks);

mysql_free_result($Rs_Record_For_Edit);
?>
