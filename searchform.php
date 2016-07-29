<form role="search" method="get" id="searchform" class="searchform" action="<?php echo $pages->get('template=search')->url; ?>">
	<div>
		<label class="screen-reader-text" for="s">Search for: </label>
		<input class="formSearchBoxJS" type="text" value="<?php echo $sanitizer->entities($input->whitelist('s')); ?>" name="s" id="s" />
		// <input type="submit" class="search-submit"
		 value="<?php echo $sanitizer->text('Search'); ?>"/>
	</div>
</form>
