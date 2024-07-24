<?php
	$errors = array();
	if (isset($_GET['id'])) {
		include 'config/connect_db.php';
		$statement = "SELECT id, name, email, birth_date, created_at FROM users where id={$_GET['id']}";
		$result = $conn->query($statement);
		$user = $result->fetch(PDO::FETCH_ASSOC);
	} else {
		$result.closeCursor();
		$conn = null;
		header('Location: index.php');
	}

	if (isset($_POST['submit'])) {
		$user['name'] = trim($_POST['name']);
		$user['email'] = trim($_POST['email']);
		$user['birth_date'] = $_POST['birth_date'];

		include 'config/validate.php';

		if (!array_filter($errors)) {
			$name = $user['name'];
			$email = $user['email'];
			$birth_date = $user['birth_date'];
			$created_at = $user['created_at'];
			$statement = "UPDATE users SET name='$name', email='$email', birth_date='$birth_date', created_at='$created_at' WHERE id={$_GET['id']}";
			$result = $conn->prepare($statement);
			if ($result->execute()) {
				header('Location: index.php');
			} else {
				echo 'Query error.';
			}
		}
	}
?>

<?php include 'templates/header.php' ?>

<?php include 'templates/navbar.php' ?>

<main class="container">
	<form action="<?php echo "{$_SERVER['PHP_SELF']}?id={$_GET['id']}"; ?>" method="POST">
		<h3 class="center">User Details</h3>
		<label for="name">Name:</label>
		<input required type="text" name="name" value="<?php echo $user['name']; ?>">
		<div class="red-text"><?php echo $errors['name'] ?? ''; ?></div>
		
		<label for="name">Email:</label>
		<input required type="email" name="email" value="<?php echo $user['email']; ?>">
		<div class="red-text"><?php echo $errors['email'] ?? ''; ?></div>

		<label for="name">Birth date:</label>
		<input required type="date" name="birth_date" value="<?php echo $user['birth_date']; ?>">

		<label for="name">Register date:</label>
		<input required type="date" name="created_at" value="<?php echo $user['created_at']; ?>">

		<div class="center">
			<input class="btn" type="submit" value="OK" name="submit">
			<a href="index.php" class="btn">Cancel</a>
		</div>
	</form>
</main>

</body>
</html>