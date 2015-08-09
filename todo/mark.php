<?php

	// This script have options to done, undone or delete note

	require_once 'app/init.php';

	if(isset($_GET['as'], $_GET['item'])) {
		$as    = $_GET['as'];
		$item  = $_GET['item'];
	}

	switch($as) {
		case 'done':
			$doneQuery = $db->prepare("
				UPDATE items 
				SET done = 1
				WHERE id = :item
				AND user = :user
			");

			$doneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;

		case 'undone':
			$undoneQuery = $db->prepare("
				UPDATE items
				SET done = 0
				WHERE id = :item
				AND user = :user
			");

			$undoneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;

		case 'delete':
			$deleteQuery = $db->prepare("
				DELETE FROM items
				WHERE id = :item
				AND user = :user
			");

			$deleteQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;
	}

header('Location: index.php');

?>