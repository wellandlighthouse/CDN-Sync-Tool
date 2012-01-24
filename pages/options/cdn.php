<div class="cst-main">
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="cdn">Content Delivery Network</label></th>
					<td>
						<select id="cdn" name="options[cst-cdn]">
							<option value="S3" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'S3') { echo 'selected="selected"'; } ?>>S3</option>
							<option value="FTP" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'FTP') { echo 'selected="selected"'; } ?>>FTP</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="cst-specific-options">

			<table class="form-table S3">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="accesskey">Access Key</label></th>
						<td><input type="text" name="options[cst-s3-accesskey]" id="accesskey" <?php if (isset(self::$options['cst-s3-accesskey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-accesskey']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="secretkey">Secret Key</label></th>
						<td><input type="text" name="options[cst-s3-secretkey]" id="secretkey" <?php if (isset(self::$options['cst-s3-secretkey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-secretkey']).'"'; } ?> /></td>
					</tr>
				</tbody>
			</table>

			<table class="form-table FTP">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="ftp-server">Server</label></th>
						<td><input type="text" name="options[cst-ftp-server]" id="ftp-server" <?php if (isset(self::$options['cst-ftp-server'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-server']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-port">Port</label></th>
						<td><input type="text" name="options[cst-ftp-port]" id="ftp-port" <?php if (isset(self::$options['cst-ftp-port'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-port']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-username">Username</label></th>
						<td><input type="text" name="options[cst-ftp-username]" id="ftp-username" <?php if (isset(self::$options['cst-ftp-username'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-username']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-password">Password</label></th>
						<td><input type="password" name="options[cst-ftp-password]" id="ftp-password" <?php if (isset(self::$options['cst-ftp-password'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-password']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-dir">Directory</label?</th>
						<td><input type="text" name="options[cst-ftp-dir]" id="ftp-dir" <?php if (isset(self::$options['cst-ftp-dir'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-dir']).'"'; } ?> /></td>
						<td><strong>Make sure the directory exists and is writable by the web server.</strong></td>
					</tr>
				</tbody>
			</table>

		</div>

		<input type="hidden" name="form" value="cst-main" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
	</form>
</div>
