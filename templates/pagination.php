<div class="container center-align">
	<ul class="pagination">
    <li class="<?php echo $page == 0 ? 'disabled' : 'wave-effect'; ?>"><a href="<?php echo $page > 0 ? $_SERVER['PHP_SELF'] . '?page=' . $page - 1 : ''; ?>"><i class="material-icons">chevron_left</i></a></li>
		<?php for ($i = 0; $i < $pageCount; $i++): ?>
			<li class="<?php echo $i == $page ? 'active' : 'wave-effect'; ?>"><a href="<?php echo "{$_SERVER['PHP_SELF']}?page=$i"; ?>"><?php echo $i + 1; ?></a></li>
		<?php endfor; ?>
		<li class="<?php echo $page >= $pageCount - 1 ? 'disabled' : 'wave-effect'; ?>"><a href="<?php echo $page < $pageCount - 1 ? $_SERVER['PHP_SELF'] . '?page=' . $page + 1: ''; ?>"><i class="material-icons">chevron_right</i></a></li>
  </ul>
</div>