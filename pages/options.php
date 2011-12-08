<div class="wrap">
	<h2>CDN Sync Tool - Options</h2>
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="cdn">Content Delivery Network</label></th>
					<td>
						<select id="cdn" name="options[cdn]">
							<option value="S3" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'S3') { echo 'selected="selected"'; } ?>>S3</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="accesskey">Access Key</label></th>
					<td><input type="text" name="options[cst-s3-accesskey]" id="accesskey" <?php if (isset(self::$options['cst-s3-accesskey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-accesskey']).'"'; } ?> /></td>
				<tr>
				<tr valign="top">
					<th scope="row"><label for="secretkey">Secret Key</label></th>
					<td><input type="text" name="options[cst-s3-secretkey]" id="secretkey" <?php if (isset(self::$options['cst-s3-secretkey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-secretkey']).'"'; } ?> /></td>
			</tbody>
		</table>
		<input type="hidden" name="form" value="options" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
	</form>
</div>