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
$StatusMessage=""; // This varible will hold the message which will be displayed to the User according to his actions , Update, delte save etc.

//------------ Code to Delete ---------------

if ((isset($_GET['UserID'])) && ($_GET['UserID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM user_accounts WHERE UserID=%s AND UserID<>1",
                       GetSQLValueString($_GET['UserID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
  if ($_GET['UserID']==1)
  $StatusMessage="Sorry! Administrator Account Can Not be Deleted";
  else
  $StatusMessage="User Account Deleted Successfully";
}

// ------ End of Delete Code ----------------

// ======================== Code for Updateing User Account Information ===================



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE user_accounts SET Password=%s, FullName=%s, AddressLine1=%s, AddressLine2=%s, City=%s, Country=%s, Phone=%s, Email=%s, ContactNo=%s, Others=%s, GroupID=%s, AccountStatus=%s WHERE UserID=%s",
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['FullName'], "text"),
                       GetSQLValueString($_POST['AddressLine1'], "text"),
                       GetSQLValueString($_POST['AddressLine2'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['ContactNo'], "text"),
                       GetSQLValueString($_POST['Others'], "text"),
                       GetSQLValueString($_POST['GroupID'], "int"),
                       GetSQLValueString($_POST['AccountStatus'], "int"),
                       GetSQLValueString($_POST['UserID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
  
}

//========================= End of User Information Update ================================
$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO user_accounts (Username, Password, FullName, AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, GroupID, AccountStatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['FullName'], "text"),
                       GetSQLValueString($_POST['AddressLine1'], "text"),
                       GetSQLValueString($_POST['AddressLine2'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['ContactNo'], "text"),
                       GetSQLValueString($_POST['Others'], "text"),
                       GetSQLValueString($_POST['GroupID'], "int"),
                       GetSQLValueString($_POST['AccountStatus'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}


$currentPage = $_SERVER["PHP_SELF"];

$SearchUsername="";
if(isset($_POST['SearchUsername']) && $_POST['SearchUsername']!="") {
   $SearchUsername="   Username='" .$_POST['SearchUsername']  ."' AND ";
}else	
	if(isset($_GET['SearchUsername']) && $_GET['SearchUsername']!="") {
	   $SearchUsername="  Username='" .$_GET['SearchUsername']  ."'  AND ";
	}

$maxRows_rs_get_user_accounts = 10;
$pageNum_rs_get_user_accounts = 0;
if (isset($_GET['pageNum_rs_get_user_accounts'])) {
  $pageNum_rs_get_user_accounts = $_GET['pageNum_rs_get_user_accounts'];
}
$startRow_rs_get_user_accounts = $pageNum_rs_get_user_accounts * $maxRows_rs_get_user_accounts;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_user_accounts = "SELECT user_accounts.*,user_groups.GroupName FROM user_accounts,user_groups WHERE $SearchUsername  user_accounts.GroupID=user_groups.GroupID ORDER BY Username ASC";
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

<?php
$CreateNewUser=false;
if  (!isset($SearchUsername))
		$CreateNewUser=true;
else
		if ($SearchUsername=="")
	 		 $CreateNewUser=true;
 if ($CreateNewUser==true) { // Show if recordset not empty ?>


<script type="text/javascript" src="lib/jquery.js"></script>
<script type='text/javascript' src='lib/jquery.autocomplete.js'></script>
<!-- <link rel="stylesheet" type="text/css" href="lib/main.css" /> -->
<link rel="stylesheet" type="text/css" href="lib/jquery.autocomplete.css" />


<script type="text/javascript">
$(document).ready(function(){
	$("#Username").focus().autocomplete('include_code/search_username.php');
});



</script>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<br />
<h3 id="why">Create User Account </h3>
<?php
   if(strlen($StatusMessage)>0 ){
     echo " <div align=\"center\">" .$StatusMessage . "</div>";
 }
    ?>

<div class="DataEntryView">
  <form action="<?php echo $editFormAction."?ID=users"; ?>" method="post" name="form1" id="form1">
    <table width="100%" align="center" cellpadding="5" cellspacing="5">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Username:</div></td>
        <td><span id="sprytextfield1">
          <input name="Username" type="text" id="Username" value="" size="20" class="ac_results" autocomplete="off"/>

        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Password:</div></td>
        <td><span id="sprytextfield3">
        <input name="Password" type="text" id="Password" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
       </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Full Name:</div></td>
        <td><span id="sprytextfield5">
        <input name="FullName" type="text" id="FullName" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Rights Group Name:</div></td>
        <td><select name="GroupID" id="GroupID">
          <?php 
do {  
?>
          <option value="<?php echo $row_rs_get_groups['GroupID']?>" <?php if (!(strcmp($row_rs_get_groups['GroupID'], 7))) {echo "SELECTED";} ?>><?php echo $row_rs_get_groups['GroupName']?></option>
          <?php
} while ($row_rs_get_groups = mysql_fetch_assoc($rs_get_groups));
?>
        </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Address Line1:</div></td>
        <td><span id="sprytextfield2">
        <input name="AddressLine1" type="text" id="AddressLine1" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Address Line2:</div></td>
        <td><span id="sprytextfield4">
          <input name="AddressLine2" type="text" id="AddressLine2" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
       </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">City:</div></td>
        <td><span id="sprytextfield6">
        <input name="City" type="text" id="City" value="Riyadh" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Country:</div></td>
        <td><span id="sprytextfield8">
        <input name="Country" type="text" id="Country" value="Saudi Arabia" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
       </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left">Phone:</div></td>
        <td><span id="sprytextfield7">
          <input name="Phone" type="text" id="Phone" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Email:</div></td>
        <td><span id="sprytextfield10">
        <input name="Email" type="text" id="Email" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
       </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left">Contact No:</div></td>
        <td><span id="sprytextfield9">
          <input name="ContactNo" type="text" id="ContactNo" value="" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Others:</div></td>
        <td><span id="sprytextfield11">
        <input name="Others" type="text" id="Others" value="N/A" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
       </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left">Account Status:</div></td>
        <td><select name="AccountStatus" id="AccountStatus">
          <option value="1" <?php if (!(strcmp(1, 1))) {echo "SELECTED";} ?>>Enable</option>
          <option value="0" <?php if (!(strcmp(0, 1))) {echo "SELECTED";} ?>>Disable</option>
        </select></td>
        <td align="right" nowrap="nowrap"><div align="left"></div></td>
        <td><input type="submit" value="Save Acount" />
        <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
       </tr>
      <tr></tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
</div>

   <?php
   }
  ?>
  <br />
  <?php //if ($totalRows_rs_get_user_accounts > 0 && isset($_POST['SearchUsername']) && $_POST['SearchUsername']!="") {
	if ($totalRows_rs_get_user_accounts > 0 && isset($SearchUsername) && $SearchUsername!="") {
	 // Show if recordset not empty ?>

<h3 id="why">Edit User Account </h3>
<br />
<form action="<?php echo $editFormAction."?ID=users"; ?>" method="post" name="form2" id="form2">
<div class="DataEntryView">
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Username:</div></td>
      <td><span id="sprytextfield12">
        <input type="text" name="Username" value="<?php echo $row_rs_get_user_accounts['Username']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Password:</div></td>
      <td><span id="sprytextfield14">
        <input type="text" name="Password" value="<?php echo $row_rs_get_user_accounts['Password']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Full Name:</div></td>
      <td><span id="sprytextfield16">
        <input type="text" name="FullName" value="<?php echo $row_rs_get_user_accounts['FullName']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Rights Group Name:</div></td>
      <td><select name="GroupID">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_get_groups['GroupID']?>" <?php if (!(strcmp($row_rs_get_groups['GroupID'], 7))) {echo "SELECTED";} ?>><?php echo $row_rs_get_groups['GroupName']?></option>
        <?php
} while ($row_rs_get_groups = mysql_fetch_assoc($rs_get_groups));
?>
        </select></td>
      </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Address Line1:</div></td>
      <td><span id="sprytextfield13">
        <input name="AddressLine1" type="text" id="AddressLine1" value="<?php echo $row_rs_get_user_accounts['AddressLine1']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Address Line2:</div></td>
      <td><span id="sprytextfield15">
        <input name="AddressLine2" type="text" id="AddressLine2" value="<?php echo $row_rs_get_user_accounts['AddressLine2']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">City:</div></td>
      <td><span id="sprytextfield17">
        <input type="text" name="City" value="<?php echo $row_rs_get_user_accounts['City']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Country:</div></td>
      <td><span id="sprytextfield19">
        <input type="text" name="Country" value="<?php echo $row_rs_get_user_accounts['Country']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left">Phone:</div></td>
      <td><span id="sprytextfield18">
        <input type="text" name="Phone" value="<?php echo $row_rs_get_user_accounts['Phone']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Email:</div></td>
      <td><span id="sprytextfield21">
        <input type="text" name="Email" value="<?php echo $row_rs_get_user_accounts['Email']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left">Contact No:</div></td>
      <td><span id="sprytextfield20">
        <input type="text" name="ContactNo" value="<?php echo $row_rs_get_user_accounts['ContactNo']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      <td align="right" nowrap="nowrap"><div align="left">Others:</div></td>
      <td><span id="sprytextfield22">
        <input type="text" name="Others" value="<?php echo $row_rs_get_user_accounts['Others']; ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left">Account Status:</div></td>
      <td><select name="AccountStatus">
        <option value="1" <?php if (!(strcmp(1, 1))) {echo "SELECTED";} ?>>Enable</option>
        <option value="0" <?php if (!(strcmp(0, 1))) {echo "SELECTED";} ?>>Disable</option>
        </select></td>
      <td align="right" nowrap="nowrap"><div align="left"></div></td>
      <td><input type="submit" value="Save Changes" /></td>
      </tr>
    <tr></tr>
  </table>
</div>
<input name="MM_update" type="hidden" id="MM_update" value="form2" />
   <input name="UserID" type="hidden" id="UserID" value="<?php echo $row_rs_get_user_accounts['UserID']; ?>" />
</form>

<p>
  <?php } // Show if recordset not empty ?>
  <br />
</p>
<div id="searchBox">
  <form id="frmSearch" name="frmSearch" method="post" action="<?php echo $currentPage."?ID=users"; ?>">
    <label for="SearchUsername">Enter Username to Search</label>
    <input type="text" name="SearchUsername" id="SearchUsername" />
    <input type="submit" name="button" id="button" value="Search" />
    (Do blank search to show all records)
  </form>
</div>
<div class="DetailView">
  <table width="100" border="0" cellpadding="5" cellspacing="5">
    <tr class="DarkHeaderRow">
     
      <th colspan="2">Action</th>
      <th width="21%">Username</th>
      <th width="20%">Password</th>
      <th width="19%">Group Name</th>
      <th width="19%">Full Name</th>
      <th width="17%">City</th>
      <th width="17%">Email</th>
    </tr>
    <?php do { ?>
      <tr>
       <td><div align="center"><a href="?ID=users&Delete=true&UserID=<?php echo $row_rs_get_user_accounts['UserID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a></div></td>
       <td><a href="?ID=users&amp;Edit=true&amp;SearchUsername=<?php echo $row_rs_get_user_accounts['Username']; ?>" class="action-link" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" width="16" height="16" alt="Edit" /></a></td>
        <td><?php echo $row_rs_get_user_accounts['Username']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['Password']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['GroupName']; ?></td>
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

mysql_free_result($rs_get_user_accounts);

mysql_free_result($rs_get_groups);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21");
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22");
</script>
