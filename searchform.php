<form role="search" id="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<input type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo __('Looking for something?' , 'gsc'); ?>"/>
<input type="hidden" name="search-type" value="all" />
<button type="submit" class="search-icon"><i class="icon-search-icon"></i></button>
</form>