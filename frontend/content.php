<!--<div class="container">-->
<!--	<div class="row">-->
		<div class="container">
			<div class="row main-slider-section">
                <div class="header-box">
                    <div class="col-12">
					<?php if (get_field('header_h3')) :?>
						<h3><?php echo get_field('header_h3');?></h3>
					<?php endif;?>
					<?php if (get_field('header_h3_description')) :?>
						<div class="h3-description"><?php echo get_field('header_h3_description'); ?></div>
					<?php endif;?>
					<?php if (get_field('header_h4')) :?>
						<h4><?php echo get_field('header_h4');?></h4>
					<?php endif;?>
					<?php if (get_field('header_h4_description')) :?>
						<div class="h4-description"><?php echo get_field('header_h4_description'); ?></div>
					<?php endif;?>
					<?php if (get_field('header_h5')) :?>
						<h5><?php echo get_field('header_h5');?></h5>
					<?php endif;?>
					<?php if (get_field('header_h5_description')) :?>
						<div class="h5-description"><?php echo get_field('header_h5_description'); ?></div>
					<?php endif;?>
                    </div>
                </div>

					<?php $main_slider_counter = 1;
					$is_slides = 0;
					while ($main_slider_counter <= 6) :
					if (get_field('main_slider_image_' . $main_slider_counter)) {
						$is_slides++;
					}
					$main_slider_counter++;
					endwhile;?>

					<?php if ($is_slides > 0) :?>
					<div id="main_carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
                        <?php $main_slider_counter = 1;
							$is_active_slider = 1;
							while ($main_slider_counter <= 6) :
							?>
							<?php if (get_field('main_slider_image_' . $main_slider_counter)) :?>
								<div class="carousel-item <?php echo ($is_active_slider == 1) ? 'active' : '' ?>">
									<img class="d-block w-100" src="<?php echo get_field('main_slider_image_' . $main_slider_counter); ?>">
								</div>
							<?php $is_active_slider++; ?>
							<?php endif; ?>
							<?php $main_slider_counter++; ?>
							<?php endwhile;?>
						</div>
						<a class="carousel-control-prev" href="#main_carousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#main_carousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
                    <?php endif;?>

					<?php $features_counter = 1;
					$is_feature = 0;
					while ($features_counter <= 14) :
						if (get_field('feature_' . $features_counter)) {
							$is_feature++;
						}
						$features_counter++;
					endwhile;?>
					<?php if ($is_feature > 0) :?>
                        <div class="features-row col-sm-12">
						<?php $features_counter = 1;
						$is_feature = 0;
						while ($features_counter <= 14) :
                                if (get_field('feature_' . $features_counter)) :?>
                                <div class="feature-item"><?php echo get_field('feature_' . $features_counter); ?></div>
                                <?php endif;?>
                        <?php
                        $features_counter++;
						endwhile;?>
                        </div>
					<?php endif;?>

                    <?php if ((get_field('call_details')) && (get_field('call_phone_number'))) : ?>
                        <div class="col-sm-12 text-center">
                            <a class="call-details" href="tel:<?php echo get_field('call_phone_number'); ?>">
                                <?php echo get_field('call_details'); ?>
                            </a>
                        </div>
                    <?php endif;?>

            </div>
        </div>


        <?php $video_counter = 0 ;
              $video_offset = '';
            if (get_field('video_url_1')) {
	            $video_counter++;
            }
            if (get_field('video_url_2')) {
                $video_counter++;
            }
            if ($video_counter == 1) {
                $video_offset ="offset-sm-3";
            }
        ?>
        <div class="container">
            <div class="row video-section">

                    <?php if (get_field('video_url_1')) : ?>
                        <div class="video-item col-sm-6 <?php echo $video_offset; ?>">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field('video_url_1'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                            </div>
                        </div>
                    <?php endif;?>
                    <?php if (get_field('video_url_2')) : ?>
                        <div class="video-item col-sm-6 <?php echo $video_offset; ?>">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_field('video_url_2'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    <?php endif;?>
            </div>
        </div>
        <div class="container">
            <div class="row second-slider-section">
                <?php
                $cs_thumb_id = get_post_thumbnail_id();
                if($cs_thumb_id) {
                    $image_box_class= "col-md-4";
                } else {
	                $image_box_class= "col-md-12";
                }
                $cs_post_id = get_the_ID();
                ?>

                <div class="single-image-box col-sm-12">
                    <div class="row">
                        <div class="image-text <?php echo $image_box_class; ?>">

                            <?php if (get_field('image_header_h2')) :?>
                                <h2><?php echo get_field('image_header_h2');?></h2>
	                        <?php endif;?>
	                        <?php if (get_field('image_header_h3')) :?>
                                <h3><?php echo get_field('image_header_h3');?></h3>
	                        <?php endif;?>
	                        <?php if (get_field('image_header_h5')) :?>
                                <h5><?php echo get_field('image_header_h5');?></h5>
	                        <?php endif;?>
	                        <?php if (get_field('image_tel_text')&&(get_field('image_tel_number'))) :?>
                                <a href="tel:<?php echo get_field('image_tel_number'); ?>"><?php echo get_field('image_tel_text');?></a>
	                        <?php endif;?>

                        </div>
                            <?php if ($cs_thumb_id) :?>
                                <div class="image-thumb col-md-8">
                                <img src="<?php echo the_post_thumbnail_url('full'); ?>" alt="">
                                </div>
                            <?php endif;?>

	                    <?php if (get_field('image_slogan')) :?>
                            <div class="col-sm-12 image-slogan"><?php echo get_field('image_slogan');?></div>
	                    <?php endif;?>
                    </div>
                </div>



	            <?php $second_slider_counter = 1;
	            $is_slides = 0;
	            while ($second_slider_counter <= 8) :
		            if (get_field('second_slider_image_' . $second_slider_counter)) {
			            $is_slides++;
		            }
		            $second_slider_counter++;
	            endwhile;?>

	            <?php if ($is_slides > 0) :?>
                    <div id="second_carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
				            <?php $second_slider_counter = 1;
				            $is_active_slider = 1;
				            while ($second_slider_counter <= 8) :
					            ?>
					            <?php if (get_field('second_slider_image_' . $second_slider_counter)) :?>
                                <div class="carousel-item <?php echo ($is_active_slider == 1) ? 'active' : '' ?>">
                                    <img class="d-block w-100" src="<?php echo get_field('second_slider_image_' . $second_slider_counter); ?>">
                                </div>
					            <?php $is_active_slider++; ?>
				            <?php endif; ?>
					            <?php $second_slider_counter++; ?>
				            <?php endwhile;?>
                        </div>
                        <a class="carousel-control-prev" href="#second_carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#second_carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
	            <?php endif;?>

            </div>
        </div>

        <?php
        $img_url = get_field('cta_bg_image');
        if ($img_url) {
            $bg = 'background-image: url('. $img_url . ');';
            $bg .= 'height: 255px;';
            $bg .= 'background-size: cover;';
        }
        else {
            $bg = 'background-color: #e9e5ce;';
	        $bg .= 'height: 255px;';

        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="cta-box col-sm-12" style="<?php echo $bg; ?>" >
                    <div class="container">
                        <div class="row">
	                        <?php if (get_field('cta_slogan')) :?>
                                <div class="col-md-10 cta-slogan"><?php echo get_field('cta_slogan');?></div>
	                        <?php endif;?>
	                        <?php if (get_field('cta_tel_number')) :?>
                                <div class="col-md-2 cta-tel-number">
                                    <a href="tel:<?php echo get_field('cta_tel_number');?>"><?php echo get_field('cta_tel_number');?></a>

                                </div>
	                        <?php endif;?>
                        </div>
                    </div>


                </div>

            </div>
        </div>
<!--	</div>-->
<!--</div>-->