<div class="cst-main">
	<form action="" method="post">
		<input type="hidden" name="form" value="cst-sync" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<div class="cst-sync-options">
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][theme]" id="cst-sync-theme"><label for="cst-sync-theme">Theme Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][media]" id="cst-sync-media"><label for="cst-sync-media">Media Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][wp]" id="cst-sync-wp"><label for="cst-sync-wp">WP Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][plugin]" id="cst-sync-plugin"><label for="cst-sync-plugin">Plugin Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][cssjs]" id="cst-sync-cssjs"><label for="cst-sync-cssjs">CSS/JS Files</label></div>
		</div>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Sync" /></p>
	</form>
</div>
