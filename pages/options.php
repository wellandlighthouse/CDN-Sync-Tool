<div class="wrap">
	<h2>CDN Sync Tool - Options</h2>
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="accesskey">Access key</label></th>
					<td><input type="text" name="options[accesskey]" id="accesskey" /></td>
				<tr>
				<tr valign="top">
					<th scope="row"><label for="secretkey">Secret Key</label></th>
					<td><input type="text" name="options[secretkey]" id="secretkey" /></td>
			</tbody>
		</table>
		<input type="hidden" name="form" value="options" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
	</form>
</div>