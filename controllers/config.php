<?php
	
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'boardGame';

  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 8889);
  return $link;
?>