<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

if(isset( $_SESSION['MM_Username'] ) && strlen( $_SESSION['MM_Username'] )>0){
       header("Location: Cpanel.php" );
}else{
	   header("Location: sign_in.php");
	}
?>