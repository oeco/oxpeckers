<form role="search" method="get" id="searchform">
    <div>
    	<input type="text" name="s" id="s" placeholder="<?php _e('Search', 'jeo'); ?>" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>" />
    </div>
</form>