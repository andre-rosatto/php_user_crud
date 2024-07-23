<?php
	include 'config/connect_db.php';

	if (isset($_POST['recover'])) {
		$id_to_recover = $_POST['id_to_recover'];
		$statement = "UPDATE users SET is_active=1 WHERE id=$id_to_recover";
		$result = $conn->prepare($statement);
		if (!$result->execute()) {
			echo 'Query error.';
		}
	} else if (isset($_POST['delete'])) {
		$id_to_delete = $_POST['id_to_delete'];
		$statement = "DELETE FROM users WHERE id=$id_to_delete";
		$result = $conn->prepare($statement);
		if (!$result->execute()) {
			echo 'Query error.';
		}
	}

	$pageSize = 50;
	$page = $_GET['page'] ?? 0;
	$offset = $page * $pageSize;

	
	$statement = "SELECT id, name, email, birth_date, created_at FROM users WHERE !is_active ORDER BY created_at DESC LIMIT $pageSize OFFSET $offset";
	$result = $conn->query($statement);
	$users = $result->fetchAll(PDO::FETCH_ASSOC);

	$statement = "SELECT COUNT(id) FROM users WHERE !is_active";
	$result = $conn->prepare($statement);
	$result->execute();
	$pageCount = ceil($result->fetchColumn() / $pageSize);

	$result->closeCursor();
	$conn = null;
?>

<?php include 'templates/header.php'; ?>

<?php include 'templates/navbar.php'; ?>

<?php include 'templates/pagination.php'; ?>

<main class="container">
	<div class="row">
		<?php foreach ($users as $user): ?>
			<div class="col s12 m4">
				<div class="card">
					<div class="card-content">
						<h3 class="card-title"><?php echo $user['name']; ?></h3>
						<p>Email: <?php echo $user['email']; ?></p>
						<p>Birth date: <?php echo date_format(date_create($user['birth_date']), 'd/m/Y'); ?></p>
						<p>Register date: <?php echo date_format(date_create($user['created_at']), 'd/m/Y'); ?></p>
					</div>
					<div class="card-action center-align">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<input type="hidden" name="id_to_delete" value="<?php echo $user['id']; ?>" />
							<input class="btn red" type="submit" name="delete" value="Delete" />

							<input type="hidden" name="id_to_recover" value="<?php echo $user['id']; ?>" />
							<input class="btn" type="submit" name="recover" value="Recover" />
						</form>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</main>

</body>
</html>