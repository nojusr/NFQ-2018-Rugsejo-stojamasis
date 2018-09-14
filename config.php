<?php
	# duombazes konfiguracija.
	$dbname = 'nfq';
	$dbuser = 'nfq';
	$dbpass = '******';
	$dbhost = 'localhost';
	$pagelength = 20;
	$charset = 'utf8';
	$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=utf8";
	$dboptions = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
	];
?>

