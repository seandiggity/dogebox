<?php
// Detect if this is an SSL connection, switch to SSL if not
if ( !isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != 'on' ) {
	//SSL is OFF
   header ('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   exit();
}
?>
