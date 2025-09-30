<?php
	$post_style = meni_el_get_single_post_style( get_the_ID() );

	$template_args['ID'] = get_the_ID();
	$template_args['Post_Style'] = $post_style; ?>

	<!-- Primary -->
	<section id="primary" class="<?php echo esc_attr( meni_el_get_primary_classes() ); ?>">
	<?php
	    do_action( 'meni_el_before_single_post_content_wrap' );

	    if( have_posts() ) {
	        while( have_posts() ) {
	            the_post();?>
	            <!-- #post-<?php the_ID(); ?> -->
	            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                <?php echo meni_el_get_template_part( 'post', 'templates/'.$post_style.'/post', '', $template_args ); ?>
	            </article><!-- #post-<?php the_ID(); ?> --><?php
	        }
	    }

	    do_action( 'meni_el_after_single_post_content_wrap', $template_args['ID'] );?>
	</section><!-- Primary End -->
	<?php meni_el_template_part( 'sidebar', 'templates/sidebar' ); ?>