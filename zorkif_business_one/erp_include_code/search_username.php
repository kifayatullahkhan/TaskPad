<?php

$connection = mysql_connect('localhost', 'root', '') or die("");
mysql_select_db("zorkif_erp", $connection);
	
	
		if(isset($_POST['Username'])) {
			$queryString = $_POST['Username'];		
			if(strlen($queryString) >0) {
				$query = "SELECT Username, FullName FROM user_accounts WHERE Username LIKE '$queryString%'";
				$result = mysql_query($query) or die("");
					while($row = mysql_fetch_array($result)){
					echo '<li title='.$row['FullName'].' onClick="fill(\''.$row['Username'].'\');">'.$row['Username'].'</li>';                                         
      }
	  }
	  }
?>



