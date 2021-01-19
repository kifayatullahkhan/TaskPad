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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO erp_departments (DepartmentName) VALUES (%s)",
                       GetSQLValueString($_POST['DepartmentName'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "") && (isset($_GET['DeleteID']))) {
  $deleteSQL = sprintf("DELETE FROM erp_departments WHERE DepartmentID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}
                     
$colname_Rs_GetSelectedDepartment = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetSelectedDepartment = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSelectedDepartment = sprintf("SELECT * FROM erp_departments WHERE DepartmentID = %s", GetSQLValueString($colname_Rs_GetSelectedDepartment, "int"));
$Rs_GetSelectedDepartment = mysql_query($query_Rs_GetSelectedDepartment, $Conn) or die(mysql_error());
$row_Rs_GetSelectedDepartment = mysql_fetch_assoc($Rs_GetSelectedDepartment);
$totalRows_Rs_GetSelectedDepartment = mysql_num_rows($Rs_GetSelectedDepartment);

mysql_select_db($database_Conn, $Conn);
/* Setting for Searching a Record Based on a Name or Description */
	$SearchText="";
	$SearchByFieldName="DepartmentName";
	if (isset($_POST['SearchText']) && $_POST['SearchText']!="Search Record…") {
	 $SearchText=" WHERE ".$SearchByFieldName ." LIKE '".$_POST['SearchText']."%'";
//$SearchText=$SearchByFieldName ." LIKE %".$_POST['SeaarchText']."%";
}
/*=============================================== */

if(!isset($_POST['SearchText'])){
$query_Rs_GetDepartments = "SELECT * FROM erp_departments ORDER BY DepartmentName ASC";
}
else {
$query_Rs_GetDepartments = "SELECT * FROM erp_departments $SearchText ORDER BY DepartmentName ASC";
}


$Rs_GetDepartments = mysql_query($query_Rs_GetDepartments, $Conn) or die(mysql_error());
$row_Rs_GetDepartments = mysql_fetch_assoc($Rs_GetDepartments);
$totalRows_Rs_GetDepartments = mysql_num_rows($Rs_GetDepartments);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE erp_departments SET DepartmentName=%s WHERE DepartmentID=%s",
                       GetSQLValueString($_POST['DepartmentName'], "text"),
                       GetSQLValueString($_POST['DepartmentID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<h3 id="why"> Business Departments</h3>
<?php if ($totalRows_Rs_GetSelectedDepartment == 0) { // Show if recordset not empty ?>
<div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <fieldset>
      <div align="center" class="DataEntryView">
        <table width="400" align="center" cellpadding="5" cellspacing="5">
        <tr valign="baseline">
          <td>Enter New Department Name</td>
        </tr>
        <tr valign="baseline">
          <td><div align="left"><span id="sprytextfield1">
                <input type="text" name="DepartmentName" value="" size="32" />
                <span class="textfieldRequiredMsg">*</span></span>
                <input type="submit" value="Save " />
            </div></td>
        </tr>
      </table>
    </div>
      <input type="hidden" name="MM_insert" value="form1" />
    </fieldset>
  </form>
</div>
  <?php } // Show if recordset not empty ?>
  
  
 <?php if ($totalRows_Rs_GetSelectedDepartment > 0) { // Show if recordset not empty ?>
 <div>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table width="400" align="center">
      <tr valign="baseline">
        <td width="289">Update Department Name</td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="DepartmentName" value="<?php echo htmlentities($row_Rs_GetSelectedDepartment['DepartmentName'], ENT_COMPAT, ''); ?>" size="32" />
          <input type="submit" value="Save Changes" /></td>
      </tr>
      </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="DepartmentID" value="<?php echo $row_Rs_GetSelectedDepartment['DepartmentID']; ?>" />
  </form>
  </div>
  <?php } // Show if recordset not empty ?>

    
    <?php if ($totalRows_Rs_GetDepartments > 0) { // Show if recordset not empty ?>
      <div class="DetailView">
        <table width="100%" border="0" cellpadding="5" cellspacing="5">
          <tr>
            <th width="8%" colspan="2">Action</th>
          <th width="92%">DepartmentName</th>
            </tr>
          <?php do { ?>
            <tr>
              <td><a href="?EditID=<?php echo $row_Rs_GetDepartments['DepartmentID']; ?>" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" alt="Delete" width="16" height="16" /></a></td>
              <td><a href="?DeleteID=<?php echo $row_Rs_GetDepartments['DepartmentID']; ?>" onclick="return confirm('Are you sure you want to Delete this record?');"><img src="images/icons/drop.gif" alt="Delete" width="16" height="16" /></a></td>
              <td><?php echo $row_Rs_GetDepartments['DepartmentName']; ?></td>
            </tr>
            <?php } while ($row_Rs_GetDepartments = mysql_fetch_assoc($Rs_GetDepartments)); ?>
        </table>
      </div>
      <?php } // Show if recordset not empty ?>


<?php if ($totalRows_Rs_GetDepartments == 0) { // Show if recordset empty ?>
    <div align="center" style="color: #FF0000">No result found </div>
  <?php } // Show if recordset empty ?>
<?php
mysql_free_result($Rs_GetDepartments);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
<?php
mysql_free_result($Rs_GetSelectedDepartment);
?>
