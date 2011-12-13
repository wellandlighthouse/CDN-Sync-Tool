jQuery(document).ready(function() {
	jQuery("." + jQuery("#cdn").val()).show();
	jQuery("#cdn").change(function() {
		jQuery("." + this.value).show().siblings().hide();
	});
});