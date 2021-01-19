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

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetProductsList = "SELECT ProductID, ProductName, ProductDescription,LinkTag  FROM products_list ORDER BY ProductName DESC";
$Rs_GetProductsList = mysql_query($query_Rs_GetProductsList, $Conn) or die(mysql_error());
$row_Rs_GetProductsList = mysql_fetch_assoc($Rs_GetProductsList);
$totalRows_Rs_GetProductsList = mysql_num_rows($Rs_GetProductsList);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCompanyInformation = "SELECT company_informaiton.*, system_config.ShowCompanyInformation FROM company_informaiton, system_config WHERE system_config.ShowCompanyInformation=1";
$Rs_GetCompanyInformation = mysql_query($query_Rs_GetCompanyInformation, $Conn) or die(mysql_error());
$row_Rs_GetCompanyInformation = mysql_fetch_assoc($Rs_GetCompanyInformation);
$totalRows_Rs_GetCompanyInformation = mysql_num_rows($Rs_GetCompanyInformation);
?>


<div id="footer">         
<ul><li>
             
             <?php
			 $Count=1;
			  do { ?>

              		<?php
					
	               if(($Count%5)==0) {
					 echo "<h4> <a href=\"?LinkTag=" .$row_Rs_GetProductsList['LinkTag']. "\">".ucfirst($row_Rs_GetProductsList['ProductName'])."</a></h4>"; 
					 echo "</li><li>";
				   }
				   else
					 {
 echo "<h4> <a href=\"?LinkTag=" .$row_Rs_GetProductsList['LinkTag']. "\">".ucfirst($row_Rs_GetProductsList['ProductName'])."</a></h4>";            		     }
                 $Count++;
					 ?>
  	
  <?php } while ($row_Rs_GetProductsList = mysql_fetch_assoc($Rs_GetProductsList)); ?>
		      </li> 
  </ul>             
</div>
<div>
  <table width="950" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="145"><a href="http://www.zorkif.com"><img src="images/ztc/ztc-logo-header.png" width="145" height="55" alt="Zorkif Technology Center" /></a></td>
    <td width="847" align="right" valign="middle" id="footer_message_text">
    	<ul>
	        <li><a href="?LinkTag=homepage">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
  	        <li><a href="?LinkTag=terms">Terms and Conditions</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
 			<li><a href="?LinkTag=sitemap">Sitemap</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
  	        <li><a href="?LinkTag=support">Support</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
			<li><a href="?LinkTag=contactus">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
  			<li><a href="?LinkTag=feedback">Feed Back</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="register.php">Register Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="index.php?ID=sendmepassword">Reset Password</a></li>
        </ul>
     </td>
  </tr>
</table>
  <?php if ($totalRows_Rs_GetCompanyInformation > 0) { // Show if recordset not empty ?>
  <div style="margin:10px; color:#FFF; font-size:10px;" align="center">
    <?php echo $row_Rs_GetCompanyInformation['CompanyName']; ?> | 
    <?php echo $row_Rs_GetCompanyInformation['AddressLine1']; ?> 
    <?php echo $row_Rs_GetCompanyInformation['AddressLine2']; ?> 
    <?php echo $row_Rs_GetCompanyInformation['City']; ?> 
    <?php echo $row_Rs_GetCompanyInformation['Country']; ?> 
    Phone: <?php echo $row_Rs_GetCompanyInformation['Phone']; ?> 
    Email: <?php echo $row_Rs_GetCompanyInformation['Email']; ?> 
  </div>
  <?php } // Show if recordset not empty ?>
</div>

<?php
mysql_free_result($Rs_GetProductsList);

mysql_free_result($Rs_GetCompanyInformation);
?>
