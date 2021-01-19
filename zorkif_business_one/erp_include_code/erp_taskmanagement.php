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

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_taskmanagement WHERE Task_ID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO erp_taskmanagement (Task_Username, Task_Title, Task_Periority, Task_Status, Task_Completion, Task_Description, Task_Start_Date, Task_Due_Date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Task_Username'], "text"),
                       GetSQLValueString($_POST['Task_Title'], "text"),
                       GetSQLValueString($_POST['Task_Periority'], "text"),
                       GetSQLValueString($_POST['Task_Status'], "text"),
                       GetSQLValueString($_POST['Task_Completion'], "int"),
                       GetSQLValueString($_POST['Task_Description'], "text"),
                       GetSQLValueString($_POST['Task_Start_Date'], "date"),
                       GetSQLValueString($_POST['Task_Due_Date'], "date")
                       );

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
  
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmUpdate")) {
  $updateSQL = sprintf("UPDATE erp_taskmanagement SET Task_Username=%s, Task_Title=%s, Task_Periority=%s, Task_Status=%s, Task_Completion=%s, Task_Description=%s, Task_Start_Date=%s, Task_Due_Date=%s WHERE Task_ID=%s",
                       GetSQLValueString($_POST['Task_Username'], "text"),
                       GetSQLValueString($_POST['Task_Title'], "text"),
                       GetSQLValueString($_POST['Task_Periority'], "text"),
                       GetSQLValueString($_POST['Task_Status'], "text"),
                       GetSQLValueString((int)$_POST['Task_Completion'], "int"),
                       GetSQLValueString($_POST['Task_Description'], "text"),
                       GetSQLValueString($_POST['Task_Start_Date'], "date"),
                       GetSQLValueString($_POST['Task_Due_Date'], "date"),
                       GetSQLValueString($_POST['Task_ID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_Rs_Add_New_Taskmanagement = "SELECT * FROM erp_taskmanagement";
$Rs_Add_New_Taskmanagement = mysql_query($query_Rs_Add_New_Taskmanagement, $Conn) or die(mysql_error());
$row_Rs_Add_New_Taskmanagement = mysql_fetch_assoc($Rs_Add_New_Taskmanagement);
$totalRows_Rs_Add_New_Taskmanagement = mysql_num_rows($Rs_Add_New_Taskmanagement);

$maxRows_Get_Task = 10;
$pageNum_Get_Task = 0;
if (isset($_GET['pageNum_Get_Task'])) {
  $pageNum_Get_Task = $_GET['pageNum_Get_Task'];
}
$startRow_Get_Task = $pageNum_Get_Task * $maxRows_Get_Task;

mysql_select_db($database_Conn, $Conn);
$query_Get_Task = "SELECT * FROM erp_taskmanagement";
if(isset($_POST['SearchText']) && strlen($_POST['SearchText'])>0) {
$query_Get_Task = "SELECT * FROM erp_taskmanagement WHERE Task_Username LIKE '%". $_POST['SearchText']	."%' OR  Task_Title LIKE '%". $_POST['SearchText']	."%' ORDER BY Task_ID DESC"; 
}
$query_limit_Get_Task = sprintf("%s LIMIT %d, %d", $query_Get_Task, $startRow_Get_Task, $maxRows_Get_Task);
$Get_Task = mysql_query($query_limit_Get_Task, $Conn) or die(mysql_error());
$row_Get_Task = mysql_fetch_assoc($Get_Task);

if (isset($_GET['totalRows_Get_Task'])) {
  $totalRows_Get_Task = $_GET['totalRows_Get_Task'];
} else {
  $all_Get_Task = mysql_query($query_Get_Task);
  $totalRows_Get_Task = mysql_num_rows($all_Get_Task);
}
$totalPages_Get_Task = ceil($totalRows_Get_Task/$maxRows_Get_Task)-1;

$colname_Rs_Delete_Task = "-1";
if (isset($_GET['DeleteID'])) {
  $colname_Rs_Delete_Task = $_GET['DeleteID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_Delete_Task = sprintf("SELECT * FROM erp_taskmanagement WHERE Task_ID = %s", GetSQLValueString($colname_Rs_Delete_Task, "int"));
$Rs_Delete_Task = mysql_query($query_Rs_Delete_Task, $Conn) or die(mysql_error());
$row_Rs_Delete_Task = mysql_fetch_assoc($Rs_Delete_Task);
$totalRows_Rs_Delete_Task = mysql_num_rows($Rs_Delete_Task);

$colname_Rs_Get_Record_For_Edit = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_Get_Record_For_Edit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_Get_Record_For_Edit = sprintf("SELECT * FROM erp_taskmanagement WHERE Task_ID = %s", GetSQLValueString($colname_Rs_Get_Record_For_Edit, "int"));
$Rs_Get_Record_For_Edit = mysql_query($query_Rs_Get_Record_For_Edit, $Conn) or die(mysql_error());
$row_Rs_Get_Record_For_Edit = mysql_fetch_assoc($Rs_Get_Record_For_Edit);
$totalRows_Rs_Get_Record_For_Edit = mysql_num_rows($Rs_Get_Record_For_Edit);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetUserNames = "SELECT UserID, Username, FullName FROM user_accounts ORDER BY Username ASC";
$Rs_GetUserNames = mysql_query($query_Rs_GetUserNames, $Conn) or die(mysql_error());
$row_Rs_GetUserNames = mysql_fetch_assoc($Rs_GetUserNames);
$totalRows_Rs_GetUserNames = mysql_num_rows($Rs_GetUserNames);

$queryString_Get_Task = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Get_Task") == false && 
        stristr($param, "totalRows_Get_Task") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Get_Task = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Get_Task = sprintf("&totalRows_Get_Task=%d%s", $totalRows_Get_Task, $queryString_Get_Task);
?>

<div>
  <?php if ($totalRows_Rs_Get_Record_For_Edit == 0) { // Show if recordset empty ?>
    <div class="DataEnteryTable">
      <h2>اضافة مهمة جديدة</h2>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="958" align="center" cellpadding="5" cellspacing="5" >
          <tr valign="baseline" class="DarkHeaderRow">
            <td colspan="7" valign="top"><strong>عنوان المهمة :</strong></td>
          </tr>
          <tr valign="baseline">
            <td colspan="7" valign="top"><input type="text" name="Task_Title" value="" size="88" placeholder="Enter the Title of the Task" /></td>
          </tr>
          <tr valign="baseline" class="DarkHeaderRow">
            <td valign="top"><strong>الموظف</strong></td>
            <td valign="top"><strong>الأهمية :</strong></td>
            <td valign="top"><strong>نسبة الانجاز %</strong></td>
            <td colspan="2" valign="top"><strong> الحالة :</strong></td>
            <td valign="top"><strong>تاريخ البدء :</strong></td>
            <td valign="top"><strong>تاريخ الانتهاء :</strong></td>
          </tr>
          <tr valign="baseline">
            <td width="210" valign="top"><select name="Task_Username">
              <?php
do {  
?>
              <option value="<?php echo $row_Rs_GetUserNames['Username']?>"><?php echo $row_Rs_GetUserNames['FullName']?></option>
              <?php
} while ($row_Rs_GetUserNames = mysql_fetch_assoc($Rs_GetUserNames));
  $rows = mysql_num_rows($Rs_GetUserNames);
  if($rows > 0) {
      mysql_data_seek($Rs_GetUserNames, 0);
	  $row_Rs_GetUserNames = mysql_fetch_assoc($Rs_GetUserNames);
  }
?>
            </select></td>
            <td width="101" valign="top"><select name="Task_Periority" id="Task_Periority">
              <option value="High">عالية</option>
              <option value="Normal"> متوسطة</option>
              <option value="Low">قليلة</option>
            </select></td>
            <td width="388" valign="top"><select  name="Task_Completion" id="Task_Completion" >
              <?php 
			  for($i=0;$i<=100;$i++){
			  echo "<option value=\"0\">$i</option>";
			  }
              ?>
            </select></td>
            <td width="388" colspan="2" valign="top"><select name="Task_Status" id="Task_Status">
              <option value="Not Started">لم تبدأ</option>
              <option value="Deferred">مؤجلة</option>
              <option value="In Progress">يتم العمل عليها</option>
              <option value="Waiting on someone else">معتمده على شخص اخر</option>
              <option value="Completed">تمت</option>
            </select></td>
            <td width="388" valign="top"><input name="Task_Start_Date" type="text" id="Task_Start_Date" value="<?php echo date('Y-m-d'); ?>" size="15" /></td>
            <td width="388" valign="top"><input name="Task_Due_Date" type="text" id="Task_Due_Date" value="<?php echo date('Y-m-d'); ?>" size="15" /></td>
          </tr>
          <tr valign="baseline" class="DarkHeaderRow">
            <td colspan="7" valign="top"><strong>الوصف :</strong></td>
          </tr>
          <tr valign="baseline">
            <td colspan="7" valign="top"><textarea name="Task_Description" cols="67" rows="5" placeholder="Enter the Details of the Task"></textarea></td>
          </tr>
          <tr valign="baseline">
            <td colspan="7"><input type="submit" value="اضافة جديد" />
            <input type="reset" name="button2" id="button2" value="الغاء">
            <input name="MM_insert" type="hidden" id="form1" value="form1" />
            </td>
          </tr>
        </table>
      </form>
    </div>
    <?php } // Show if recordset empty ?>
  <?php if ($totalRows_Rs_Get_Record_For_Edit > 0) { // Show if recordset not empty ?>
  <div>
    <h2>تحديث المهمة </h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="frmUpdate" id="frmUpdate">
      <table width="843" align="center" cellpadding="10" cellspacing="5">
        <tr valign="baseline" class="DarkHeaderRow">
          <td colspan="7"><strong>عنوان المهمة</strong></td>
        </tr>
        <tr valign="baseline">
          <td colspan="7"><input type="text" name="Task_Title" value="<?php echo htmlentities($row_Rs_Get_Record_For_Edit['Task_Title'], ENT_COMPAT, 'utf-8'); ?>" size="86" /></td>
          </tr>
        <tr class="DarkHeaderRow">
          <td><strong>الموظف</strong></td>
          <td><strong>الأهمية</strong></td>
          <td><strong>الانجاز %</strong></td>
          <td><strong>الحالة :</strong></td>
          <td><strong>تاريخ البدء :</strong></td>
          <td><strong>تاريخ الانتهاء :</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td width="201"><input type="text" name="Task_Username" value="<?php echo htmlentities($row_Rs_Get_Record_For_Edit['Task_Username'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          <td width="114"><select name="Task_Periority" id="Task_Periority">
            <option value="High" <?php if (!(strcmp("High", $row_Rs_Get_Record_For_Edit['Task_Periority']))) {echo "selected=\"selected\"";} ?>>عالية</option>
            <option value="Normal" <?php if (!(strcmp("Normal", $row_Rs_Get_Record_For_Edit['Task_Periority']))) {echo "selected=\"selected\"";} ?>>متوسطة</option>
            <option value="Low" <?php if (!(strcmp("Low", $row_Rs_Get_Record_For_Edit['Task_Periority']))) {echo "selected=\"selected\"";} ?>>قليلة</option>
            </select></td>
          <td width="335" ><select  name="Task_Completion" id="Task_Completion" >
            <?php 
 for($i=0;$i<=100;$i++) {  
?>
            <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $row_Rs_Get_Record_For_Edit['Task_Completion']))) {echo "SELECTED";} ?>><?php echo $i; ?></option>
            <?php
 }
 ?>
            </select></td>
            <td><select name="Task_Status" id="Task_Status">
              <option value="Not Started" <?php if (!(strcmp("Not Started", $row_Rs_Get_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>لم تبدأ</option>
              <option value="In Progress" <?php if (!(strcmp("In Progress", $row_Rs_Get_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>يتم العمل عليها</option>
              <option value="Completed" <?php if (!(strcmp("Completed", $row_Rs_Get_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>تمت</option>
              <option value="Deferred" <?php if (!(strcmp("Deferred", $row_Rs_Get_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>مؤجلة</option>
              <option value="Waiting on someone else" <?php if (!(strcmp("Waiting on someone else", $row_Rs_Get_Record_For_Edit['Task_Status']))) {echo "selected=\"selected\"";} ?>>معتمده على شخص آخر</option>
            </select></td>
          <td width="335"><input type="text" name="Task_Start_Date" id="Task_Start_Date" value="<?php echo htmlentities($row_Rs_Get_Record_For_Edit['Task_Start_Date'], ENT_COMPAT, 'utf-8'); ?>" size="15"  /></td>
          <td width="335"><input name="Task_Due_Date"  id="Task_Due_Date" type="text"value="<?php echo htmlentities($row_Rs_Get_Record_For_Edit['Task_Due_Date'], ENT_COMPAT, 'utf-8'); ?>" size="15" /></td>
          <td width="335">&nbsp;</td>
        </tr>
        <tr valign="baseline" class="DarkHeaderRow">
          <td colspan="7"><div align="left"><strong>الوصف :</strong></div></td>
        </tr>
        <tr valign="baseline">
          <td colspan="7"><textarea name="Task_Description" cols="67" rows="5"><?php echo htmlentities($row_Rs_Get_Record_For_Edit['Task_Description'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
        </tr>
        <tr valign="baseline">
          <td colspan="7" nowrap="nowrap"><input type="submit" value="حفظ" />
            <input type="submit" name="button" id="button" value="الغاء"></td>
          </tr>
        </table>
      <input type="hidden" name="MM_update" value="frmUpdate" />
      <input type="hidden" name="Task_ID" value="<?php echo $row_Rs_Get_Record_For_Edit['Task_ID']; ?>" />
      </form>
  </div>
  <?php } // Show if recordset not empty ?>
 <div>
     <h2>عرض تفاصيل المهمة</h2>
    <p>فلترة <form action="" method="post"><select name="SearchText">
         <option value="">عرض الكل</option>
              <?php
			 mysqli_data_seek($Rs_GetUserNames,0);
			 
do {  
?>
              <option value="<?php echo $row_Rs_GetUserNames['Username']?>"><?php echo $row_Rs_GetUserNames['FullName']?></option>
              <?php
} while ($row_Rs_GetUserNames = mysql_fetch_assoc($Rs_GetUserNames));
  $rows = mysql_num_rows($Rs_GetUserNames);
  if($rows > 0) {
      mysql_data_seek($Rs_GetUserNames, 0);
	  $row_Rs_GetUserNames = mysql_fetch_assoc($Rs_GetUserNames);
  }
?>
           <input name="FilterBy" type="hidden" value="Username" /> </select><input name="Submit" type="submit" value="عرض" /></form></p>
 </div>
  <?php if($totalRows_Get_Task > 0 ) { ?>
  <div>

    <table border="0" cellpadding="0" cellspacing="0">
      <tr class="DarkHeaderRow">
     
      <td colspan="3">الاجراء</td>
        <td>الاسم</td>
        <td>العنوان</td>
        <td>الاهمية</td>
        <td>الحالة</td>
        <td>الاكتمال</td>
        <td>تاريخ البدء</td>
        <td>الى تاريخ</td>
        <td>تاريخ الاكتمال</td>
      </tr>
      <tbody>
      <?php
	  $RowClass="light";
	  $i=0;
	   do {
		   $i++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">
      
        <td><a href="erp_task_details.php?TaskID=<?php echo $row_Get_Task['Task_ID']; ?>">عرض</a></td>
        <td><a href="?EditID=<?php echo $row_Get_Task['Task_ID']; ?>">تعديل</a></td>
        <td><a href="?DeleteID=<?php echo $row_Get_Task['Task_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">حذف</a></td>
        <td><?php echo $row_Get_Task['Task_Username']; ?></td>
        <td><?php echo $row_Get_Task['Task_Title']; ?></td>
        <td><?php echo $row_Get_Task['Task_Periority']; ?></td>
        <td><?php echo $row_Get_Task['Task_Status']; ?></td>
        <td class="small"><?php echo $row_Get_Task['Task_Completion']; ?>%</td>
        <td class="small"><?php echo $row_Get_Task['Task_Start_Date']; ?></td>
        <td class="small"><?php echo $row_Get_Task['Task_Due_Date']; ?></td>
        <td class="small"><?php echo $row_Get_Task['Task_Complete_Date']; ?></td>
      </tr>
      <?php } while ($row_Get_Task = mysql_fetch_assoc($Get_Task)); ?>
    </tbody>
    </table>
    <div align="center">
      <p>&nbsp;      
      <table border="0">
        <tr>
          <td><?php if ($pageNum_Get_Task > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Get_Task=%d%s", $currentPage, 0, $queryString_Get_Task); ?>">First</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_Get_Task > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Get_Task=%d%s", $currentPage, max(0, $pageNum_Get_Task - 1), $queryString_Get_Task); ?>">Previous</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_Get_Task < $totalPages_Get_Task) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Get_Task=%d%s", $currentPage, min($totalPages_Get_Task, $pageNum_Get_Task + 1), $queryString_Get_Task); ?>">Next</a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_Get_Task < $totalPages_Get_Task) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Get_Task=%d%s", $currentPage, $totalPages_Get_Task, $queryString_Get_Task); ?>">Last</a>
              <?php } // Show if not last page ?></td>
        </tr>
      </table>
      </p>
    </div>
  </div>
</div>
<?php } ?> 
<?php if($totalRows_Get_Task==0) { ?>
<div>
  <div align="center" style="color: #FF0000">لا يوجد نتائج</div>
</div>
<?php } ?>


<p>
  <?php
mysql_free_result($Rs_Add_New_Taskmanagement);

mysql_free_result($Get_Task);

mysql_free_result($Rs_Delete_Task);

mysql_free_result($Rs_Get_Record_For_Edit);

mysql_free_result($Rs_GetUserNames);
?>
</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<script type="text/javascript">
    $(function() {
        $( "#Task_Start_Date" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#Task_Due_Date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>