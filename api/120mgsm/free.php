<?php
error_reporting(0);
if(isset($_POST['gsm']))
{
	$gsm=$_POST['gsm'];

	
    echo file_get_contents("http://185.255.93.177:3000/api/gsm/$gsm");
	

}

?>