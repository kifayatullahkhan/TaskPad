<?php require_once("Connections/Conn.php"); ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" lang="ar" dir="rtl"><!-- InstanceBegin template="/Templates/ZB1_DetailPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>User's Management (Password Recovery via Email) |  Zorkif Taskpad</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
    
<!-- jQuery UI Datepicker -->
<script src="scripts/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui.js"></script>
<!-- End of jQuery Datepicker -->
    
    
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />





</head>
<body id="top">
<div class="wrapper col1">
  
</div>
<div class="wrapper DarkHeaderRow">
  <div id="topbar">
    <div id="topnav">
      <?php require_once("include_code/page_top_menu_bar.php"); ?>
    </div>
    <div id="search">
      <form action="" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" name="SearchText" value="Search Record&hellip;"  id="SearchText" onFocus="this.value=(this.value=='Search Record&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col3">
  <div id="breadcrumb"><!-- InstanceBeginEditable name="ER_ConentPageLocation" -->
    <ul>
      <li class="first">Quick Links</li>
      <li>&#187;</li>
      <li><a href="cpanel.php">Home</a></li>
      <li>&#187;</li>
      <li><a href="user_password_recovery_via_email.php">User Password Recovery</a></li>
      
    </ul>
  <!-- InstanceEndEditable --></div>
</div>
<div class="wrapper col5">
  <div id="container"><!-- InstanceBeginEditable name="ER_MainContent1" -->
  <div id="content">
  <?php require_once('include_code/user_password_recovery_via_email.php'); ?>

  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="ER_CONTENT2" --><?php require_once("include_code/CPanel_RIGHT_PANEL_DEFAULT.php");?><!-- InstanceEndEditable -->
  <div class="clear"></div>
  </div>
</div>
<div class="wrapper col6">
  
</div>
<div class="wrapper col7">
  <div id="copyright">
    <p class="fl_left">CityNET Taskpad.  Copyright &copy; <?php echo date('Y') -1 ."-". date('Y'); ?> - All Rights Reserved -CityNET.com.co<a href="http://www.zorkif.com"></a></p>
    <p class="fl_right">CityNET Co.</p>
    <br class="clear" />
  </div>
</div>
</body>
<!-- InstanceEnd --></html>
