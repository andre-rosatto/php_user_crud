<?php
	// validate name
	if (empty($user['name'])) {
		$errors['name'] = 'A name is required.';
	} else if (strlen($user['name']) < 5) {
		$errors['name'] = 'Names must be at least 5 characters long.';
	} else if (!preg_match('/^[a-zA-Z\s]+$/', $user['name'])) {
		$errors['name'] = 'Names must contain letters only';
	}

	// validate email
	if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Email must be a valid email address.';
	}