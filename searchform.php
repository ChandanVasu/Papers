<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-form-input" class="screen-reader-text"><?php _e( 'Search for:', 'your-theme-textdomain' ); ?></label>
    <input type="search" id="search-form-input" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'your-theme-textdomain' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
</form>
