<?php get_header(); ?>

<?php the_post(); ?>
	<!-- 1 -->
<?php cs_blade_grve_print_header_title( 'page', 'Special page' ); ?>
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
					$counter = 0;
					$post_number_in_query = 0;
					if (get_option('cs_repeat_time')) {
						$repeat_time = get_option('cs_repeat_time');
					} else {
						$repeat_time = '-1';
					}
					if (get_option('cs_init_post_id')) {
						$cs_init_post_id = get_option('cs_init_post_id');
					} else {
						$cs_init_post_id = '-1';
					}
					if (get_option('cs_init_date')) {
						$cs_init_date = get_option('cs_init_date');
					} else {
						$cs_init_date = '-1';
					}
					$specials_list = new WP_Query(array('post_type' => 'special', 'posts_per_page' => -1, 'order' => 'ASC'));
					if ( $specials_list->have_posts() ) :


						while ( $specials_list->have_posts()) : $specials_list->the_post();
							$id = get_post_thumbnail_id();
							$post_id = get_the_ID();
							if ($cs_init_post_id == $post_id ) {
								$post_number_in_query = $counter;
							}
							$counter++;
							//echo $counter;
						endwhile;




						if (($repeat_time == '-1') || ($cs_init_post_id == '-1') || ($cs_init_date == '-1')) {
							echo '<h2 class="text-center">No data to show</h2>';
						} else {
//							date_default_timezone_set('Europe/Kiev');
//							date_default_timezone_set('America/New_York');
							$cs_current_date=time();
							$delta = $cs_current_date - $cs_init_date;
							if ( $repeat_time == '1' ) {
								$steps = floor($delta / 86400);
							}
							if ( $repeat_time == '7' ) {
								$steps = floor($delta / (86400 * 7));
							}
                            if ( $repeat_time == '14' ) {
                                $steps = floor($delta / (86400 * 7 * 2));
                            }
							$cs_current_post = ($post_number_in_query + $steps) % $counter;

//                            echo $delta / (86400 * 7);
//                            echo "<br>";
//                            echo(date("Y-m-d H:i:s",$cs_init_date));
//                            echo "<br>";
//                            echo(date("Y-m-d H:i:s",$cs_init_date + ($steps * 86400)));
//                            echo "<br>";
//
//                            echo $post_number_in_query;
//                            echo "<br>";
//
//                            echo $steps;
//								echo "<br>";
//                                echo $cs_current_post;
//							echo 'init date ' . $cs_init_date . '<br>';
//							$cs_current_date=time();
//							echo 'current date ' . $cs_current_date . '<br>';
//							$delta = $cs_current_date - $cs_init_date;
//							echo 'difference date ' . $delta . '<br>';
//							echo (date("i s",$delta)) . '<br>';
//							echo (date("i",$delta)) . '<br>';
//							$minutes = date("i",$delta);
//							$cs_current_post = $minutes % $counter -1;
//							echo 'current post number' . $cs_current_post . '<br>';
//							$date = new DateTime();
//							echo $date->getTimestamp();
//							echo '<br>';
//							echo date('Y-m-d H:i:s');
//							echo '<br>';
//							$t=time();
//							echo($t . "<br>");
//							echo(date("Y-m-d",$t));
						}

					endif;
					wp_reset_query();

					?>
					<?php
                        if (($repeat_time == '-1') || ($cs_init_post_id == '-1') || ($cs_init_date == '-1')) {
                            ;
                        } else {
                            $specials_list = new WP_Query(array('post_type' => 'special', 'posts_per_page' => 1, 'order' => 'ASC', 'offset' => $cs_current_post));
                            if ($specials_list->have_posts()) :
                                while ($specials_list->have_posts()) : $specials_list->the_post();
                                    $id = get_post_thumbnail_id();
                                    $post_id = get_the_ID();
                                    //echo the_content();
                                    //echo date('Y-m-d H:i:s', $cs_current_date) . ' current date <br>';
                                    //echo date('Y-m-d H:i:s', $cs_init_date) . 'init date <br>';
                                    //echo $steps . '<br>';
                                    ?>
                                    <!-- PAGE CONTENT -->
                                    <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <?php
                                        require_once('content.php');
                                        ?>
                                    </div>
                                    <!-- END PAGE CONTENT -->
                                    <?php

                                endwhile;
                            endif;
                            wp_reset_query();
                        }
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
