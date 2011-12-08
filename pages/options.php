<div class="wrap">
	<h2>CDN Sync Tool - Options</h2>
	<form action="" method="post">
		<label>Access key</label><input type="text" name="options[accesskey]" />
		<label>Secret key</label><input type="text" name="options[secretkey]" />
		<input type="hidden" name="form" value="options" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<input type="submit" name="submit" value="submit" />
	</form>
</div>