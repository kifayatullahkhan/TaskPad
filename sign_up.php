<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr"><!-- InstanceBegin template="/Templates/DetailPage.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head profile="http://gmpg.org/xfn/11">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sign Up | Zorkif Technology Center</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="#"><img src="images/zorkif_logo.jpg" width="300" height="140" alt="Zorkif Technology Center" longdesc="http://www.zorkif.com" /></a></h1>
      <p align="right"><strong>PEOPLE MAKING TECHNOLOGY WORK</strong></p>
    </div>
    <div id="newsletter">
      <p>Sign up to our newsletter for the latest news, updates and offers.</p>
      <form action="news_letter_add.php" method="post">
        <fieldset>
          <legend>NewsLetter</legend>
          <input name="FullName" type="text" id="FullName"  onfocus="this.value=(this.value=='Name&hellip;')? '' : this.value ;" value="Name&hellip;" />
          <input name="Email" type="text" id="Email"  onfocus="this.value=(this.value=='Email&hellip;')? '' : this.value ;" value="Email&hellip;" />
          <input type="submit" name="news_go" id="news_go" value="Sign Up" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper DarkHeaderRow">
  <div id="topbar">
    <div id="topnav">
      <?php require_once("top_bar_menu.php"); ?>
    </div>
    <div id="search">
      <form action="search_web.php" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" value="Search Our Website&hellip;"  onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
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
      <li><a href="index.php">Home</a></li>
      <li>&#187;</li>
      <li><a href="sign_up.php">Sign Up</a>
    </li></ul>
  <!-- InstanceEndEditable --></div>
</div>
<div class="wrapper col5">
  <div id="container"><!-- InstanceBeginEditable name="ER_MainContent1" -->
    <div id="content">
      <h1>Sign Up</h1>
      <img class="imgr" src="images/sign_up.jpg" alt="" width="100" height="100" />
      <p>Register your account with us, and get access to our library, support system and other features.      </p>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
          <td>User Name</td>
          <td><label for="Username"></label>
          <input type="text" name="Username" id="Username" /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><label for="Password"></label>
            <input type="text" name="Password" id="Password" />
          <input type="submit" name="BtnSignIn" id="BtnSignIn" value="Sign In" /></td>
        </tr>
      </table>
      <p>&nbsp;  </p>

 <?php  require_once ("show_page_comments_entry_form.php"); ?>
      
    </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="ER_CONTENT2" -->
  <div id="column">
    <div class="subnav">
      <h2>Product Description</h2>
      <ul>

        <li><a href="#screenshots">Screen Shots</a>
          </li><li><a href="#">User Manual</a>
            </li><li><a href="order_now.php">Order Now</a></li>
        </ul>
      </div>
    <div class="holder">
      <h2 class="title"><img src="images/play_button.png" alt="" /><a href="http://www.youtube.com/thezorkif">Our Youtube Channel</a></h2>
      <p>There are so many other videos and training demos on our youtube channel <a href="http://www.youtube.com/thezorkif">thezorkif</a>.</p>
      <p class="readmore"><a href="http://www.youtube.com/thezorkif">View our Youtube channel &raquo;</a></p>
      </div>
    <div id="featured">
      <ul>
        <li>
          <h2>Get your Trial Version</h2>
          <p class="imgholder"><img src="images/download_now.gif" alt="" /></p>
          <p>All our trial version applications are limited in functionality. Some sections of the applications are restricted while others may only show the form without any workings, all these are intentional to prevent our company's interest. </p>
          </li>
        </ul>
      </div>
    <div class="holder">
      <h2>Installation Requirements</h2>
      <p>To install this application you will need the following:</p>
      <ul>
        <li><a href="http://www.microsoft.com/sqlserver/2008/en/us/trial-software.aspx">MS SQL Server 2005/2008</a></li>
        <li><a href="http://www.microsoft.com/downloads/en/details.aspx?FamilyID=333325FD-AE52-4E35-B531-508D977D32A6">Microsoft .Net Framework 3.5</a></li>
        <li><a href="http://resources.businessobjects.com/support/downloads/redistributables/vs_2008/redist/x86/CRRedist2008_x86.msi">Crystal Report Viewer 10.5 (32bit)</a></li>
        <li><a href="http://www.microsoft.com/downloads/en/details.aspx?familyid=889482fc-5f56-4a38-b838-de776fd4138c&amp;displaylang=en">Winodws Installer 3.1</a></li>
        </ul>
      <p>All the above applications must be installed correctly. Some of our applications required <a href="http://www.microsoft.com/downloads/en/details.aspx?FamilyID=9CFB2D51-5FF4-4491-B0E5-B386F32C0992">Microsfot .Net Framwork 4.1</a> and <a href="http://www.microsoft.com/downloads/en/details.aspx?FamilyId=5A58B56F-60B6-4412-95B9-54D056D6F9F4&amp;displaylang=en">Winodws Installer 4.1</a>, Please download the appropriate version. </p>
      </div>
             <!-- Search Tags -->
       <div class="holder">
        <h2>Tags</h2>
        ICT Company, IT Company, Fiber Optic Installation Company, Network Installation Company, Telecommunication Company, Mobily, STC, Zain,  Cisco Routers, Cisco Router Configuration, Microsoft Windows 2008 Server, Microsoft, Exchange Server, Computer Hardware, Software Development, Web Site Designing, Graphics Designing, Windows 7, Learning Computer Networks, The Best IT Company in Saudi Arabia. Domain Name Registration, Free Web Hosting, Zorkif, Zorkif Technology Center, Networking Company, The Best Networking Company  in Saudi Arabia, Network Engineers.
       </div>
       <!--Search Tags --> 
  </div>

  <!-- InstanceEndEditable -->
  <div class="clear"></div>
  </div>
</div>
<div class="wrapper col6">
  <div id="footer">
    <div id="login">
      <h2>Client Login !</h2>
      <p>Clients can Login to their accounts here.</p>
      <form action="zorkif_business_one/sign_in/sign_in.php" method="post">
        <fieldset>
          <legend>Client Login</legend>
          <div class="fl_left">
            <input name="Username" type="text" value="Enter Username&hellip;"  onfocus="this.value=(this.value=='Enter Username&hellip;')? '' : this.value ;" />
            <input name="Password" type="password"  onfocus="this.value=(this.value=='Enter password&hellip;')? '' : this.value ;" nametype="password" />
          </div>
          <div class="fl_right">
            <input type="submit" name="login_go" id="login_go" value="&raquo;" />
          </div>
        </fieldset>
      </form>
      <p><a href="reset_password.php">&raquo; Lost Your Password</a> | <a href="sign_up.php">Create An Account &raquo;</a></p>
    </div>
    <div class="footbox">
      <h2>Security Solutions</h2>
      <ul>
        <li class="last">Get Security systems, alarm systems &amp; security cameras! Security for your home or business.</li>
      </ul>
    </div>
    <div class="footbox">
      <h2> Software Dev.</h2>
      <ul>
        <li class="last">Our Software development devision has done excellent jobs all these   years, and provided excellent software and web applications. <a href="pharmacy_point_of_sale.php"></a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Network Solutions</h2>
      <ul>
        <li class="last">We have a team of experiences and qualified Network System Engineers and Technicians to do excellent jobs for our clients.</li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col7">
  <div id="copyright">
    <p class="fl_left">CityNET Taskpad.  Copyright &copy; <?php echo date('Y') -1 ."-". date('Y'); ?> - All Rights Reserved -CityNET.com.co<a href="http://www.zorkif.com"></a></p>
    <p class="fl_right">CityNET Co.</p>
    <br class="clear" />
    <br class="clear" />
  </div>
</div>
</body>
<!-- InstanceEnd --></html>
