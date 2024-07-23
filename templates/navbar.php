<nav>
	<div class="nav-wrapper">
		<ul class="container center">
			<li class="<?php if ($_SERVER['PHP_SELF'] === '/index.php') echo 'active'; ?>">
				<a href="index.php">Users</a>
			</li>
			<li class="<?php if ($_SERVER['PHP_SELF'] === '/new.php') echo 'active'; ?>">
				<a href="new.php">New user</a>
			</li>
			<li class="<?php if ($_SERVER['PHP_SELF'] === '/bin.php') echo 'active'; ?>">
				<a href="bin.php">Binned users</a>
			</li>
		</ul>
	</div>
</nav>