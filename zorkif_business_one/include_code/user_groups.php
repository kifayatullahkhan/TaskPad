<?php
$DEFAULT_SYSTEM_GROUP_LIMITED=12;
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO user_groups (GroupName, GroupDescription) VALUES (%s, %s)",
                       GetSQLValueString($_POST['GroupName'], "text"),
                       GetSQLValueString($_POST['GroupDescription'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE user_groups SET GroupName=%s, GroupDescription=%s WHERE GroupID=%s",
                       GetSQLValueString($_POST['GroupName'], "text"),
                       GetSQLValueString($_POST['GroupDescription'], "text"),
                       GetSQLValueString($_POST['GroupID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")  && ($_GET['DeleteID'] >$DEFAULT_SYSTEM_GROUP_LIMITED)) {
  $deleteSQL = sprintf("DELETE FROM user_groups WHERE GroupID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

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
$query_Rs_GetUserGroups = "SELECT * FROM user_groups ORDER BY GroupID ASC";
}
else {
$query_Rs_GetUserGroups = "SELECT * FROM user_groups $SearchText ORDER BY GroupID ASC";
}


$Rs_GetUserGroups = mysql_query($query_Rs_GetUserGroups, $Conn) or die(mysql_error());
$row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups);
$totalRows_Rs_GetUserGroups = mysql_num_rows($Rs_GetUserGroups);

$colname_Rs_GetGroupForEdit = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetGroupForEdit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetGroupForEdit = sprintf("SELECT * FROM user_groups WHERE GroupID = %s", GetSQLValueString($colname_Rs_GetGroupForEdit, "int"));
$Rs_GetGroupForEdit = mysql_query($query_Rs_GetGroupForEdit, $Conn) or die(mysql_error());
$row_Rs_GetGroupForEdit = mysql_fetch_assoc($Rs_GetGroupForEdit);
$totalRows_Rs_GetGroupForEdit = mysql_num_rows($Rs_GetGroupForEdit);
?>
<style type="text/css">
.DataEntryView #form1 table tr td {
	text-align: left;
}
</style>


<br />
<h3 id="why">&#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1575;&#1578;</h3>
<p>&nbsp;</p>
<?php if ($totalRows_Rs_GetGroupForEdit == 0) { // Show if recordset empty ?>
  <div class="DataEntryView" >
    <h3> &#1575;&#1606;&#1588;&#1575;&#1569; &#1605;&#1580;&#1605;&#1608;&#1593;&#1577; &#1580;&#1583;&#1610;&#1583;&#1577;</h3>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center"  width="100%">
        <tr valign="baseline">
          <td width="23%" align="right" nowrap="nowrap"><div align="left">&#1575;&#1587;&#1605; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</div></td>
          <td width="77%"><input type="text" name="GroupName" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&#1608;&#1589;&#1601; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</td>
          <td><input type="text" name="GroupDescription" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><div align="left"></div></td>
          <td><input type="submit" value="&#1581;&#1601;&#1592;" />
          <input type="button" name="btnCancel" id="btnCancel" value="&#1575;&#1604;&#1594;&#1575;&#1569;" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
  </div>
  <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
<?php if ($totalRows_Rs_GetGroupForEdit > 0) { // Show if recordset not empty ?>
  <div class="DataEntryView">
    <h3>&#1578;&#1593;&#1583;&#1610;&#1604; &#1575;&#1587;&#1605; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</h3>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center" width="100%">
        <tr valign="baseline">
          <td width="22%" align="right" nowrap="nowrap"><div align="left">&#1575;&#1587;&#1605; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</div></td>
          <td width="78%"><input type="text" name="GroupName" value="<?php echo htmlentities($row_Rs_GetGroupForEdit['GroupName'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><div align="left">&#1608;&#1589;&#1601; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</div></td>
          <td><input type="text" name="GroupDescription" value="<?php echo htmlentities($row_Rs_GetGroupForEdit['GroupDescription'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right"><div align="left"></div></td>
          <td><input type="submit" value="&#1581;&#1601;&#1592;" />
          <input type="button" name="btnCancel2" id="btnCancel2" value="&#1575;&#1604;&#1594;&#1575;&#1569;" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="GroupID" value="<?php echo $row_Rs_GetGroupForEdit['GroupID']; ?>" />
    </form>
    <p>&nbsp;</p>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_Rs_GetUserGroups > 0) { // Show if recordset not empty ?>
  <div class="DetailView">
    <h3>&#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1575;&#1578;</h3>
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr class="DarkHeaderRow">
        <th width="17%">&#1575;&#1604;&#1575;&#1580;&#1585;&#1575;&#1569;</th>
        <th width="34%">&#1575;&#1587;&#1605; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</th>
        <th width="49%">&#1608;&#1589;&#1601; &#1575;&#1604;&#1605;&#1580;&#1605;&#1608;&#1593;&#1577;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            
            <?php if ($row_Rs_GetUserGroups['GroupID']>$DEFAULT_SYSTEM_GROUP_LIMITED) { ?>
            <a href="?ID=groups&DeleteID=<?php echo $row_Rs_GetUserGroups['GroupID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a> | <a href="?ID=groups&EditID=<?php echo $row_Rs_GetUserGroups['GroupID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" width="16" height="16" alt="Edit" /></a>
            <?php }else{ ?>
            Locked
            <?php } // end of Group ?>          </td>
          <td><?php echo $row_Rs_GetUserGroups['GroupName']; ?></td>
          <td><?php echo $row_Rs_GetUserGroups['GroupDescription']; ?></td>
        </tr>
        <?php } while ($row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups)); ?>
    </table>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_Rs_GetUserGroups == 0) { // Show if recordset empty ?>
    <div>
      <div align="center" style="color: #FF0000">&#1604;&#1575; &#1610;&#1608;&#1580;&#1583; &#1606;&#1578;&#1575;&#1574;&#1580;</div>
  </div>
    <?php } // Show if recordset empty ?>
<?php
mysql_free_result($Rs_GetUserGroups);

mysql_free_result($Rs_GetGroupForEdit);
?>
  
