<div class="cst-main">
	<form action="" method="post">
		<input type="hidden" name="form" value="cst-sync" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Sync" /></p>
	</form>
</div>