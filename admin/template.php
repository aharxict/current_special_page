<?php // var_dump($_REQUEST);
if ($_REQUEST[repeat_time]) {
    $repeat_time = $_REQUEST[repeat_time];
    update_option( 'cs_repeat_time', $repeat_time );
    //echo '<br>' . $repeat_time . '<br>';
}
if ($_REQUEST[cs_init_post_id]) {
    $cs_init_post_id = $_REQUEST[cs_init_post_id];
    update_option( 'cs_init_post_id', $cs_init_post_id );
    //echo '<br>' . $cs_init_post_id . '<br>';
}
if (($_REQUEST[repeat_time] == '1') || ($_REQUEST[repeat_time] == '7')) {
	date_default_timezone_set('Europe/Kiev');
	$cs_init_date = time();
	$hours = date("H");
	$minutes = date ("i");
	$seconds = date("s");
	$cs_init_date = $cs_init_date - $hours * 60 * 60 - $minutes * 60 - $seconds;
	update_option( 'cs_init_date', $cs_init_date );
}

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
?>

<div class="wrap">
<h2> <?php echo get_admin_page_title(); ?> </h2>
</div>
<div class="options-container">
        <form method="post" enctype="multipart/form-data" action="options-general.php?page=cs_option_menu_page">
            <h2>Choose starting post</h2>
            <select name="cs_init_post_id">
                <option value="-1" <?php selected( $cs_init_post_id, '-1' )?> >Not choosed</option>

            <?php
            $specials_list = new WP_Query(array('post_type' => 'special', 'posts_per_page' => -1, 'order' => 'ASC'));
            if ( $specials_list->have_posts() ) :
                while ( $specials_list->have_posts()) : $specials_list->the_post();
                    $id = get_post_thumbnail_id();
                    $post_id = get_the_ID();
                    ?>
                    <option value="<?php echo $post_id?>" <?php selected( $cs_init_post_id, $post_id )?> ><?php echo get_the_title(); ?></option>
                    <?php
                endwhile;
            endif;
            wp_reset_query();

            //		$f = get_the_ID();
            //		var_dump($f);
            //		var_dump($_REQUEST['post']);
            ?>
            </select>
            <h2>Choose repeat time</h2>
            <select name="repeat_time">
                <option value="-1" <?php selected( $repeat_time, '-1' )?> >Not repeat</option>
                <option value="1"  <?php selected( $repeat_time, '1' )?>>1 Day</option>
                <option value="7"  <?php selected( $repeat_time, '7' )?>>1 Week</option>
            </select>
            <p class="submit">
<!--                Name:<br><input type="text" name="name" value="--><?php //echo $initial_post;?><!--"><br>-->
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
</div>