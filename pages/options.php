<div class="wrap">
	<h2>CDN Sync Tool - Options</h2>

	<div id="nav">
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if (!isset($_GET['section']) || $_GET['section'] == 'main') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=main'; ?>">CST Main</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'js') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=js'; ?>">JS</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'css') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=css'; ?>">CSS</a>
		</h2>
	</div>

	<?php if (isset($_GET['section']) && $_GET['section'] == 'js') { ?>
		<div class="cst-js">
			<p>JS Stuffs</p>
		</div>
	<?php } else if (isset($_GET['section']) && $_GET['section'] == 'css') { ?>
		<div class="cst-css">
			<p>CSS Stuffs</p>
		</div>
	<?php } else { ?>
		<div class="cst-main">
			<form action="" method="post">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="cdn">Content Delivery Network</label></th>
							<td>
								<select id="cdn" name="options[cst-cdn]">
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
				<input type="hidden" name="form" value="cst-main" />
				<?php wp_nonce_field('cst-nonce'); ?>
				<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
			</form>
		</div>
	<?php } ?>
</div>