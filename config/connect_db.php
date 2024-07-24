<?php
	try {
		$conn = new PDO('mysql:host=localhost;dbname=php_user_crud;charset=utf8', 'root', 'root');
	} catch (PDOException $e) {
		echo "connection error: $e";
	}