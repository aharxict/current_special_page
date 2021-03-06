<?php if( current_user_can('editor') || current_user_can('administrator') ) {

} else {
    wp_redirect(home_url());

}
?>


<?php get_header(); ?>

<?php the_post(); ?>
    <!-- 1 -->
<?php blade_grve_print_header_title( 'page' ); ?>
    <!-- 2 -->
<?php blade_grve_print_header_breadcrumbs( 'page' ); ?>
    <!-- 3 -->
<?php blade_grve_print_anchor_menu( 'page' ); ?>

<?php
if ( 'yes' == blade_grve_post_meta( 'grve_disable_content' ) ) {
    get_footer();
} else {
    ?>
    <!-- CONTENT -->
    <div id="grve-content" class="clearfix <?php echo blade_grve_sidebar_class( 'page' ); ?>">
        <!--		<div class="grve-content-wrapper">-->
        <!-- MAIN CONTENT -->
        <!--			<div id="grve-main-content">-->
        <!--				<div class="grve-main-content-wrapper clearfix">-->

        <?php

                    ?>
                    <!-- PAGE CONTENT -->
                    <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php
                        require_once('content.php');
                        ?>
                    </div>
                    <!-- END PAGE CONTENT -->
                    <?php


        ?>




        <?php if ( blade_grve_visibility( 'page_comments_visibility' ) ) { ?>
            <?php comments_template(); ?>
        <?php } ?>

        <!--				</div>-->
        <!--			</div>-->
        <!-- END MAIN CONTENT -->
        <!---->
        <!--			--><?php //blade_grve_set_current_view( 'page' ); ?>
        <!--			--><?php//// get_sidebar(); ?>
        <!---->
        <!--		</div>-->
    </div>
    <!-- END CONTENT -->

    <?php get_footer(); ?>

    <?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

