<?php

	require_once 'app/init.php';

	$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
	");

	$itemsQuery->execute([
		'user' => $_SESSION['user_id']
	]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To do list</title>

		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<link rel="stylesheet" href="<?php testParsing(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>

		<div class="list">
			<h1 class="header"> To do.</h1>

			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
				<li>
					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?></span>
					<a class="delete-button" href="mark.php?as=delete&item=<?php echo $item['id']; ?>">Delete</a>
					<?php if(!$item['done']): ?> 
						<a class="done-button" href="mark.php?as=done&item=<?php echo $item['id']; ?>">Mark as done</a>
					<?php else: ?>
						<a class="undone-button" href="mark.php?as=undone&item=<?php echo $item['id']; ?>">Mark as undone</a>						
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<p>You haven't added any items yet.</p>
			<?php endif; ?>

			<form class="item-add" action="add.php" method="POST">
				<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" maxlength="30" required>
				<input type="submit" value="Add" class="submit">
			</form>

		</div>

	</body>

</html>