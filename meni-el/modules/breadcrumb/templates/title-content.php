<section class="main-title-section-wrapper <?php echo esc_attr( $wrapper_classes );?>">
    <div class="main-title-section-container">
        <div class="container">
            <?php echo meni_el_breadcrumbs( array( 'text' => $home, 'link' => $home_link ), $delimiter );?>
            <div class="main-title-section"><?php echo meni_el_breadcrumb_title();?></div>
        </div>
    </div>
    <div class="main-title-section-bg"></div>
</section>