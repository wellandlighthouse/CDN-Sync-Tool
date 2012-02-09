<div class="cst-js">
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label>Combine JS files</label></th>
					<td>
						<input type="radio" value="yes" name="options[cst-js-combine]" id="cst-js-combine-yes" <?php if (get_option('cst-js-combine') == 'yes') { echo 'checked="checked"'; }?>><label for="cst-js-combine-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" name="options[cst-js-combine]" id="cst-js-combine-no" <?php if (get_option('cst-js-combine') == 'no') { echo 'checked="checked"'; } ?>><label for="cst-js-combine-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="cst-js-savepath">Save path</label></th>
					<td>
						<input type="text" id="cst-js-savepath" name="options[cst-js-savepath]" value="<?php echo get_option('cst-js-savepath'); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="form" value="cst-js" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save" /></p>
	</form>
</div>
