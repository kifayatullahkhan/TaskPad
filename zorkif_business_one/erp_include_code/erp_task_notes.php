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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO erp_taskmanagement_notes (Task_ID, Task_Date, Task_Notice) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Task_ID'], "int"),
                       GetSQLValueString(date("Y-m-d"), "date"),
                       GetSQLValueString($_POST['Task_Notice'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE erp_taskmanagement_notes SET Task_Date=%s, Task_Notice=%s WHERE TNID=%s",
                       GetSQLValueString(date("Y-m-d"), "date"),
                       GetSQLValueString($_POST['Task_Notice'], "text"),
                       GetSQLValueString($_POST['TNID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_taskmanagement_notes WHERE TNID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
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

$maxRows_RsShowAllNotes = 20;
$pageNum_RsShowAllNotes = 0;
if (isset($_GET['pageNum_RsShowAllNotes'])) {
  $pageNum_RsShowAllNotes = $_GET['pageNum_RsShowAllNotes'];
}
$startRow_RsShowAllNotes = $pageNum_RsShowAllNotes * $maxRows_RsShowAllNotes;

$colname_RsShowAllNotes = "-1";
if (isset($_GET['TaskID'])) {
  $colname_RsShowAllNotes = $_GET['TaskID'];
}
mysql_select_db($database_Conn, $Conn);

$query_RsShowAllNotes = sprintf("SELECT * FROM erp_taskmanagement_notes WHERE Task_ID = %s ORDER BY TNID DESC", GetSQLValueString($colname_RsShowAllNotes, "int"));
$query_limit_RsShowAllNotes = sprintf("%s LIMIT %d, %d", $query_RsShowAllNotes, $startRow_RsShowAllNotes, $maxRows_RsShowAllNotes);
$RsShowAllNotes = mysql_query($query_limit_RsShowAllNotes, $Conn) or die(mysql_error());
$row_RsShowAllNotes = mysql_fetch_assoc($RsShowAllNotes);

if (isset($_GET['totalRows_RsShowAllNotes'])) {
  $totalRows_RsShowAllNotes = $_GET['totalRows_RsShowAllNotes'];
} else {
  $all_RsShowAllNotes = mysql_query($query_RsShowAllNotes);
  $totalRows_RsShowAllNotes = mysql_num_rows($all_RsShowAllNotes);
}
$totalPages_RsShowAllNotes = ceil($totalRows_RsShowAllNotes/$maxRows_RsShowAllNotes)-1;

$colname_RsShowSelectedNote = "-1";
if (isset($_GET['EditID'])) {
  $colname_RsShowSelectedNote = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsShowSelectedNote = sprintf("SELECT TNID, Task_Date, Task_Notice FROM erp_taskmanagement_notes WHERE TNID = %s", GetSQLValueString($colname_RsShowSelectedNote, "int"));
$RsShowSelectedNote = mysql_query($query_RsShowSelectedNote, $Conn) or die(mysql_error());
$row_RsShowSelectedNote = mysql_fetch_assoc($RsShowSelectedNote);
$totalRows_RsShowSelectedNote = mysql_num_rows($RsShowSelectedNote);

$queryString_RsShowAllNotes = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsShowAllNotes") == false && 
        stristr($param, "totalRows_RsShowAllNotes") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsShowAllNotes = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsShowAllNotes = sprintf("&totalRows_RsShowAllNotes=%d%s", $totalRows_RsShowAllNotes, $queryString_RsShowAllNotes);
?>
<div>
  <h2>تفاصيل المهمة  </h2>
  <table border="1">
    <tr class="DarkHeaderRow">
      <td>العنوان</td>
      <td>الاهمية</td>
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
<p>&nbsp;</p>
</div>

<p>&nbsp;</p>
<?php if ($totalRows_RsShowSelectedNote == 0) { // Show if recordset empty ?>
  <div>
    <h2>اضافة ملاحظه لهذه المهمة</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="100%" align="center">
        <tr valign="baseline">
          <td>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td><textarea name="Task_Notice" cols="50" rows="5" style="width:99%"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td><input type="submit" value="حفظ" /></td>
        </tr>
      </table>
      <input name="Task_ID" type="hidden" id="Task_ID" value="<?php echo $_GET['TaskID']; ?>" />
      
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
  </div>
  <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
<?php if ($totalRows_RsShowSelectedNote > 0) { // Show if recordset not empty ?>
  <div>
    <h2>تعديل الملاحظه</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table width="100%" align="center">
        <tr valign="baseline">
          <td><textarea name="Task_Notice" cols="50" rows="5" value=""  style="width:99%" />  <?php echo htmlentities($row_RsShowSelectedNote['Task_Notice'], ENT_COMPAT, ''); ?>      
            </textarea></td>
        </tr>
        <tr valign="baseline">
          <td><input type="submit" value="حفظ" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="TNID" value="<?php echo $row_RsShowSelectedNote['TNID']; ?>" />
    </form>
  </div>
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
<div>
  <h2>عرض جميع الملاحظات  </h2>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr class="DarkHeaderRow">
      <td width="15%">الاجراء</td>
      <td width="61%">ملاحظات</td>
      <td width="24%">تاريخ النشر</td>
    </tr>
      <?php
	  $RowClass="light";
	  $i=0;
	   do {
		   $i++;
		   if($i%2==0)$RowClass="light"; else $RowClass="dark";
		    ?>
      <tr class="<?php echo $RowClass; ?>">
        <td><a href="?TaskID=<?php echo $_GET['TaskID']; ?>&EditID=<?php echo $row_RsShowAllNotes['TNID']; ?>">تعديل</a> | <a href="?TaskID=<?php echo $_GET['TaskID']; ?>&DeleteID=<?php echo $row_RsShowAllNotes['TNID']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">حذف</a></td>
        <td><?php echo $row_RsShowAllNotes['Task_Notice']; ?></td>
        <td><?php echo $row_RsShowAllNotes['Task_Date']; ?></td>
      </tr>
      <?php } while ($row_RsShowAllNotes = mysql_fetch_assoc($RsShowAllNotes)); ?>
  </table>
  <div>
    <div align="center">
      <table border="0">
        <tr>
          <td><?php if ($pageNum_RsShowAllNotes > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RsShowAllNotes=%d%s", $currentPage, 0, $queryString_RsShowAllNotes); ?>">First</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_RsShowAllNotes > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_RsShowAllNotes=%d%s", $currentPage, max(0, $pageNum_RsShowAllNotes - 1), $queryString_RsShowAllNotes); ?>">Previous</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_RsShowAllNotes < $totalPages_RsShowAllNotes) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RsShowAllNotes=%d%s", $currentPage, min($totalPages_RsShowAllNotes, $pageNum_RsShowAllNotes + 1), $queryString_RsShowAllNotes); ?>">Next</a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_RsShowAllNotes < $totalPages_RsShowAllNotes) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_RsShowAllNotes=%d%s", $currentPage, $totalPages_RsShowAllNotes, $queryString_RsShowAllNotes); ?>">Last</a>
              <?php } // Show if not last page ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
 
mysql_free_result($RsShowSelectedNote);
mysql_free_result($RsShowTaskDetails);
mysql_free_result($RsShowAllNotes);
?>
