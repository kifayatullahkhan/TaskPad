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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "form1") {
 
 
 	  $Items=$_POST['App_Module_ID'];
	  foreach ($Items as $Item) {
	 
		 if ($Items>0) {
		  $insertSQL = sprintf("INSERT INTO user_groups_accessrights (App_Module_ID, GroupID) VALUES (%s, %s)",
							   GetSQLValueString( $Item, "int"),
							   GetSQLValueString($_POST['GroupID'], "int"));
			 mysql_select_db($database_Conn, $Conn);
			 $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());						   
		 }
					 
	 }
}


if ((isset($_GET['AccessID'])) && ($_GET['AccessID'] != "") && (isset($_GET['Delete']))) {
  $deleteSQL = sprintf("DELETE FROM user_groups_accessrights WHERE user_groups_accessrights_ID=%s",
                       GetSQLValueString($_GET['AccessID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}
 


if (isset($_POST['DeleteSelected'])) {
	  $Items=$_POST['user_groups_accessrights_ID'];
	  foreach ($Items as $Item) {	 
			 if ($Items>0) {
					  $deleteSQL = sprintf("DELETE FROM user_groups_accessrights WHERE user_groups_accessrights_ID=%s",
										   GetSQLValueString($Item, "int"));
					
					  mysql_select_db($database_Conn, $Conn);
					  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
		  
			 }
	  }
}
 
 

 
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetUserGroups = "SELECT GroupID, GroupName FROM user_groups WHERE GroupID > 1 ORDER BY GroupName ASC";
$Rs_GetUserGroups = mysql_query($query_Rs_GetUserGroups, $Conn) or die(mysql_error());
$row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups);
$totalRows_Rs_GetUserGroups = mysql_num_rows($Rs_GetUserGroups);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetAppModules = "SELECT * FROM application_modules ORDER BY App_Module_Name ASC";
$Rs_GetAppModules = mysql_query($query_Rs_GetAppModules, $Conn) or die(mysql_error());
$row_Rs_GetAppModules = mysql_fetch_assoc($Rs_GetAppModules);
$totalRows_Rs_GetAppModules = mysql_num_rows($Rs_GetAppModules);

mysql_select_db($database_Conn, $Conn);
/* Setting for Searching a Record Based on a Name or Description */
	$SearchText="";
	$SearchByFieldName="GroupName";
	if (isset($_POST['SearchText']) && $_POST['SearchText']!="Search Record…") {
	 $SearchText=" WHERE ".$SearchByFieldName ." LIKE '".$_POST['SearchText']."%'";
//$SearchText=$SearchByFieldName ." LIKE %".$_POST['SeaarchText']."%";
}
/*=============================================== */

if(!isset($_POST['SearchText'])){
$query_Rs_GetRightsList = "SELECT user_groups_accessrights.user_groups_accessrights_ID, user_groups.GroupName, application_modules.App_Module_Name, user_groups_accessrights.App_Module_ID FROM user_groups, application_modules, user_groups_accessrights WHERE user_groups_accessrights.App_Module_ID = application_modules.App_Module_ID AND user_groups_accessrights.GroupID =user_groups.GroupID ORDER BY user_groups_accessrights.GroupID";
}
else {
$query_Rs_GetRightsList = "SELECT user_groups_accessrights.user_groups_accessrights_ID, user_groups.GroupName, application_modules.App_Module_Name, user_groups_accessrights.App_Module_ID FROM user_groups, application_modules, user_groups_accessrights $SearchText AND user_groups_accessrights.App_Module_ID = application_modules.App_Module_ID AND user_groups_accessrights.GroupID =user_groups.GroupID ORDER BY user_groups_accessrights.GroupID";
}

$Rs_GetRightsList = mysql_query($query_Rs_GetRightsList, $Conn) or die(mysql_error());
$row_Rs_GetRightsList = mysql_fetch_assoc($Rs_GetRightsList);
$totalRows_Rs_GetRightsList = mysql_num_rows($Rs_GetRightsList);
?>
<h3 id="why"> Assign Application Modules Access Rights to a User's Group</h3>
<div align="left" class="DetailView">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left">Select the Group's Name:
      <select name="GroupID">
        <?php 
do {  
?>
        <option value="<?php echo $row_Rs_GetUserGroups['GroupID']?>" ><?php echo $row_Rs_GetUserGroups['GroupName']?></option>
        <?php
} while ($row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups));
?>
        </select></th>
    <th align="left">(Please select the  group to which you want to allow access to  modules below)</th>
  </tr>
  <tr>
    <th width="41%">Module Name</th>
    <th width="59%">Comments</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="left"><input type="checkbox" name="App_Module_ID[]" value="<?php echo $row_Rs_GetAppModules['App_Module_ID']; ?>" id="App_Module_ID[]" />
        <?php echo $row_Rs_GetAppModules['App_Module_Name']; ?></td>
      <td align="left"><?php echo $row_Rs_GetAppModules['Comments']; ?></td>
    </tr>
    <?php } while ($row_Rs_GetAppModules = mysql_fetch_assoc($Rs_GetAppModules)); ?>
</table>
<div>
  <div align="right">
    <input type="submit" value="Allow Access to Selected Modules" />
  </div>
</div>
    <input type="hidden" name="MM_insert" value="form1">
  </form>
</div>
<br />
<br />
<?php if ($totalRows_Rs_GetRightsList > 0) { // Show if recordset not empty ?>
  <div align="center" class="DetailView" style="overflow:scroll; height:300px;">
    <form name="FrmDeleteSelected" action="" method="post">
      <table width="100%" border="0" cellpadding="5" cellspacing="5">
        <tr class="DarkHeaderRow">
          <th width="10%" colspan="2" align="center">Action</th>
          <th width="28%">Group Name</th>
          <th width="62%">Application Module Name</th>
        </tr>
        <?php do { ?>
          <tr>
            <td align="left" class="action-link-column"><a href="?ID=accessrights&Delete=true&AccessID=<?php echo $row_Rs_GetRightsList['user_groups_accessrights_ID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a></td>
            <td align="left" class="action-link-column"><input type="checkbox" name="user_groups_accessrights_ID[]" value ="<?php echo $row_Rs_GetRightsList['user_groups_accessrights_ID']; ?>" id="user_groups_accessrights_ID[]" />              <label for="user_groups_accessrights_ID[]"></label></td>
            <td align="left"><?php echo $row_Rs_GetRightsList['GroupName']; ?></td>
            <td align="left"><?php echo $row_Rs_GetRightsList['App_Module_Name']; ?></td>
          </tr>
          <?php } while ($row_Rs_GetRightsList = mysql_fetch_assoc($Rs_GetRightsList)); ?>
      </table>
      <div align="right">
        <input name="DeleteSelected" type="hidden" id="DeleteSelected" value="1" />
        <input name="BtnDeleteSelected" type="submit" value="Delete Sellected Reocrds" />
        <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" />
      </div>
    </form>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_Rs_GetRightsList == 0) { // Show if recordset empty ?>
  <div>
    <div align="center" style="color: #FF0000">No result found </div>
  </div>
  <?php } // Show if recordset empty ?>
<?php
mysql_free_result($Rs_GetUserGroups);
mysql_free_result($Rs_GetAppModules);
mysql_free_result($Rs_GetRightsList);
?>
