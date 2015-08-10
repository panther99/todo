<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=todo;host=localhost', 'root', 'nikola94smeker');

if(!isset($_SESSION['user_id'])) {
	die('You\'re not signed in!');
}

function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>