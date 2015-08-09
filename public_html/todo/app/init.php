<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=database_name;host=localhost', 'user', 'password');

if(!isset($_SESSION['user_id'])) {
	die('You\'re not signed in!');
}

?>