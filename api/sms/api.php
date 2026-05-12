
<?php
include "../../server/authcontrol.php";
error_reporting(0);
if(isset($_GET['no']))
{
	$tc=$_GET['no'];

	
    echo file_get_contents("http://160.20.109.132/borkenwilson/sms.php?gsm=$tc");
	

}

?>