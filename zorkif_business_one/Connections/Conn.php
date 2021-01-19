<?php
/* 
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conn = "localhost";
$database_Conn = "saimacms";
$username_Conn = "root";
$password_Conn = "";
@$Conn = mysql_pconnect($hostname_Conn, $username_Conn, $password_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 
*/

/* The Above code has been disabled in order to have only one connection file on the main root of the web application and be easy for Updates of Connection String Details */

require_once ("../Connections/Conn.php");  // The Connection from the root Filder of the web application

?>