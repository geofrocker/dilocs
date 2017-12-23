<?php
//database credentials
define('DBHOST','127.0.0.1');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','PesaPal');

$dbo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>