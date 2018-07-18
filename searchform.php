<?php
/**
 * default search form
 * 
 * this php file is the file that the wp theme searches for to use as the default template for the search form element 
 * our child theme needs this file in order to make accessibility changes to the searchform (or any changes to the search form)
 * Changes made: added appropriate aria-label attribute for screen readers to know where & what a search form element is
 */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
    	<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'presentation' ); ?></label>
        <input type="search" placeholder="<?php echo esc_attr( 'Search…', 'presentation' ); ?>" name="s" id="s" aria-label="Search" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <input class="screen-reader-text" type="submit" id="searchsubmit" value="Search" />
    </div>
</form>
