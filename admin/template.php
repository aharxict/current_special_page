<?php // var_dump($_REQUEST);
if ($_REQUEST[repeat_time]) {
    $repeat_time = $_REQUEST[repeat_time];
    update_option( 'cs_repeat_time', $repeat_time );
    //echo '<br>' . $repeat_time . '<br>';
}
if ($_REQUEST[start_day]) {
    $start_day = $_REQUEST[start_day];
    update_option( 'cs_start_day', $start_day );
    //echo '<br>' . $start_day . '<br>';
}
if ($_REQUEST[cs_init_post_id]) {
    $cs_init_post_id = $_REQUEST[cs_init_post_id];
    update_option( 'cs_init_post_id', $cs_init_post_id );
    //echo '<br>' . $cs_init_post_id . '<br>';
}
if (get_option('cs_start_day')) {
    $start_day = get_option('cs_start_day');
} else {
    $start_day = '-1';
}

if (($_REQUEST[repeat_time] == '1') || ($_REQUEST[repeat_time] == '7') || ($_REQUEST[repeat_time] == '14')) {
	//date_default_timezone_set('Europe/Kiev');
//	date_default_timezone_set('America/New_York');
	$cs_init_date = time();
	$hours = date("H");
	$minutes = date ("i");
	$seconds = date("s");
	$cs_init_date = $cs_init_date - $hours * 60 * 60 - $minutes * 60 - $seconds;
	if (!($start_day == '-1')) {
        $day = date('N', $cs_init_date);

        $cs_init_date = $cs_init_date - ((($day - $start_day) < 0 ) ?  (7 + $day - $start_day) : ($day - $start_day)) * 86400;
    }
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
if (get_option('cs_init_date')) {
    $cs_init_date = get_option('cs_init_date');
} else {
    $cs_init_date = '-1';
}

//echo 'DAY - ' . $day = date('N') . '<br> ';

//echo date("Y-m-d H:i:s",$cs_init_date);
?>

<div class="wrap">
<h2> <?php echo get_admin_page_title(); ?> </h2>
</div>
<div class="options-container">
<!--            <pre>-->
<!--                --><?php
//                echo $start_day;
//                echo $day;
//                ?>
<!--            </pre>-->
            <h3>Setted date - <?php echo date("Y-m-d H:i:s",$cs_init_date); ?></h3>
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
            <h2>Choose starting day</h2>
            <select name="start_day">
                <option value="-1" <?php selected( $start_day, '-1' )?> >Not choosed</option>
                <option value="1"  <?php selected( $start_day, '1' )?>>Monday</option>
                <option value="2"  <?php selected( $start_day, '2' )?>>Tuesday</option>
                <option value="3"  <?php selected( $start_day, '3' )?>>Wednesday</option>
                <option value="4"  <?php selected( $start_day, '4' )?>>Thursday</option>
                <option value="5"  <?php selected( $start_day, '5' )?>>Friday</option>
                <option value="6"  <?php selected( $start_day, '6' )?>>Saturday</option>
                <option value="7"  <?php selected( $start_day, '7' )?>>Sunday</option>
            </select>
            <h2>Choose repeat time</h2>
            <select name="repeat_time">
                <option value="-1" <?php selected( $repeat_time, '-1' )?> >Not repeat</option>
                <option value="1"  <?php selected( $repeat_time, '1' )?>>1 Day</option>
                <option value="7"  <?php selected( $repeat_time, '7' )?>>1 Week</option>
                <option value="14"  <?php selected( $repeat_time, '14' )?>>2 Weeks</option>
            </select>
            <p class="submit">
<!--                Name:<br><input type="text" name="name" value="--><?php //echo $initial_post;?><!--"><br>-->
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
</div>