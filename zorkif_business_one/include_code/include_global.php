<?php

define("USERS_FILE_UPLOAD_PATH","../user_uploads/files/");

define("USERS_FILE_UPLOAD_PATH_PICTURE_GALLERY","../user_uploads/files/pic_gallery_images/");
define("VIEW_USERS_FILE_UPLOAD_PATH_PICTURE_GALLERY","user_uploads/files/pic_gallery_images/");

define("USERS_FILE_UPLOAD_PATH_FILE_SHARING","../user_uploads/files/file_sharing/");
define("VIEW_USERS_FILE_UPLOAD_PATH_FILE_SHARING","user_uploads/files/file_sharing/");


define("USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH","../user_uploads/profiles/");
define("USERS_FILE_UPLOAD_PATH_TICKET_ATTACHEMENTS","../user_uploads/files/ticket_attachements/");
define("USERS_FILE_UPLOAD_PATH_EMS","../user_uploads/files/ems/");
define("USERS_FILE_UPLOAD_PATH_ERP_CUSTOMERS","../user_uploads/files/erp_customers/");
define("USERS_JOB_SEEKER_RESUME_UPLOAD_PATH","../user_uploads/profiles/resumes/");
define("STANDARD_DATE_FORMAT","d/m/Y");


function ZorkifMessageBox($TextMessage,$MessageTitle="No Title Defined"){
 				echo "<div class=\"MessageBox\">
				      <div class=\"MessageTitle\">". $MessageTitle ."</div>
                      <p align=\"left\"> " . $TextMessage ."</p>
					<div class=\"MessageBoxIcon\"></div>				
					</div>";
}



function format_bytes($bytes) {
   if ($bytes < 1024) return $bytes.' B';
   elseif ($bytes < 1048576) return round($bytes / 1024, 2).' KB';
   elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).' MB';
   elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).' GB';
   else return round($bytes / 1099511627776, 2).' TB';
}

function getFileSize($FileName){
	if (file_exists($FileName)){
		return format_bytes(filesize($FileName));
	}else{
		return "File Not Found";	
	}
}

function date_diff_in_days($date1, $date2) {
    $current = $date1;
    $datetime2 = date_create($date2);
    $count = 0;
    while(date_create($current) < $datetime2){
        $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
        $count++;
    }
    return $count;
} 

if (isset($_GET['ln'])) { $_SESSION['ln'] = $_GET['ln']; }


/*
App_Module_ID 	App_Module_Name 		     			Comment
---------------------------------------------------------------------------------------------------------------
1 				User Management          				This section of the Application has all user accou
2 				Web Management  						This section of the Application deals with web pag...
3 				News and Testimonials	 				To manage dynamic addtion of news and testimonials...
4 				Tickets System Administration 			This section of the application helps the administ...
5 				Tickets System User's Panel 			This section of the Application has ticket submiss...
6 				Financial Management 					This section of the Application deals with dynamic...
7 				File Sharing 							This section deals with users file shairing
8 				Extra Tools 							This section of the application provides acces to ...
9 				Hotel Management System 				Hotel or Places Management System
10 				ERP Configuration Setup 				The Main Configuration Area for Setting Up ERP App...
11 				Purchase Order and Proforma Invoices 	Define Purchase Orders , supplier details, proform...
12 				Salesman Order		 					Salesman Order for Customers, Adding his own custo...
13 				Sales Order Processing 					This unit of the business will process the orders ...
14 				Inventory System 						This unit of the software will maintain the Stock ...
15 				Accounting System 						This unit of the software will perform all the bas...
16 				Delivery Order Form 					This unit of the software will handle the delivery...
17 				Production Unit 						This Module of the software will keep track of the...
18 				Wearhouse (Delivery Order Form)			This Module of the software will keep track of the...
19 				Reports 								This section will have access to the Reports of th...
	
*/
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

function GetAccessRightsForThisSectionInERP($GroupID,$ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		if ($GroupID==1) return 1;  // Administrator has Access to All modules of the applications
		$SQLQuery="SELECT * from user_groups_accessrights WHERE App_Module_ID=$ApplicationModuleID AND  GroupID=$GroupID";
		$rs_GetAccessRightsForThisSectionInERP = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSectionInERP = mysql_fetch_assoc($rs_GetAccessRightsForThisSectionInERP);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSectionInERP);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}
function GetAccessRightsForThisSection($GroupID,$ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		if ($GroupID==1) return 1;  // Administrator has Access to All modules of the applications
		$SQLQuery="SELECT * from user_groups_accessrights WHERE App_Module_ID=$ApplicationModuleID AND  GroupID=$GroupID";
		$rs_GetAccessRightsForThisSection = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSection = mysql_fetch_assoc($rs_GetAccessRightsForThisSection);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSection);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}

// This functon checks if a module has access allowed for every user group / 1= Allowed 0=not allowed
function Get_Allow_Everyone_AccessessRights($ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		
		$SQLQuery="SELECT * from application_modules WHERE App_Module_ID=$ApplicationModuleID AND  Allow_Everyone=1";
		$rs_GetAccessRightsForThisSection = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSection = mysql_fetch_assoc($rs_GetAccessRightsForThisSection);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSection);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}
// ------------------ Start of Piccture Resize Code -----------------------
// The Code Below is Used to Resise a Picutre that is upload to the server
//------------------------------------------------------------------------
class ResizeImage{
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}

// --------------- End of Picture Resieze Code --------------------------
?>
