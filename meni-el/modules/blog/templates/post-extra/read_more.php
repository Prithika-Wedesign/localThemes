<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $archive_readmore_text != '' ) :
		echo '<!-- Entry Button --><div class="entry-button wdt-core-button">';
			echo '<a href="'.get_permalink().'" title="'.the_title_attribute('echo=0').'" class="wdt-button">'.esc_html($archive_readmore_text).'<i aria-hidden="true" class="fas fa-angle-right"></i></a>';
		echo '</div><!-- Entry Button -->';
	endif; ?>