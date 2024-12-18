<?php
/**
*		Used car SINGLE
*  	------------
*
* 	@version 0.0.4
*   @package WordPress
*   @subpackage Mybooking Used car Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<!-- Gets custom fields data -->
<?php
 	$used_car_details_gallery = get_post_meta( $post->ID, 'used-car-details-gallery-data', true );
	if ( isset( $used_car_details_gallery ) && !empty( $used_car_details_gallery ) ) {
		$used_car_details_photos_url_array = $used_car_details_gallery['image_url'];
	}
	else {
		$used_car_details_photos_url_array = [];
	}
	$used_car_details_photos_count = sizeof($used_car_details_photos_url_array);
	$used_car_details_price = get_post_meta( $post->ID, 'used-car-details-price', true );
	$used_car_details_brand = get_post_meta( $post->ID, 'used-car-details-brand', true );
	$used_car_details_model = get_post_meta( $post->ID, 'used-car-details-model', true );
  // Get the terms of the taxonomy
  $brand_term = get_term( $used_car_details_brand, 'brand' );
  $model_term = get_term( $used_car_details_model, 'brand' );
  // Get the values of the taxonomy
  $used_car_details_brand = $brand_term ? $brand_term->name : ''; 
  $used_car_details_model = $model_term ? $model_term->name : '';	
	$used_car_details_year = get_post_meta( $post->ID, 'used-car-details-year', true );
	$used_car_details_kms = get_post_meta( $post->ID, 'used-car-details-kms', true );

	$used_car_details_places = get_post_meta( $post->ID, 'used-car-details-places', true );
	$used_car_details_solar_panels = get_post_meta( $post->ID, 'used-car-details-solar-panels', true );
	$used_car_details_beds = get_post_meta( $post->ID, 'used-car-details-beds', true );
	$used_car_details_license = get_post_meta( $post->ID, 'used-car-details-license', true );
	$used_car_details_lenght = get_post_meta( $post->ID, 'used-car-details-lenght', true );
	$used_car_details_width = get_post_meta( $post->ID, 'used-car-details-width', true );
	$used_car_details_height = get_post_meta( $post->ID, 'used-car-details-height', true );
	$used_car_details_plate = get_post_meta( $post->ID, 'used-car-details-plate', true );
	$used_car_details_fuel = get_post_meta( $post->ID, 'used-car-details-fuel', true );
	$used_car_details_engine = get_post_meta( $post->ID, 'used-car-details-engine', true );
	$used_car_details_gear = get_post_meta( $post->ID, 'used-car-details-gear', true );
	$used_car_details_power = get_post_meta( $post->ID, 'used-car-details-power', true );
	$used_car_details_conditioned = get_post_meta( $post->ID, 'used-car-details-conditioned', true );
	$used_car_details_shower = get_post_meta( $post->ID, 'used-car-details-shower', true );
	$used_car_details_hob = get_post_meta( $post->ID, 'used-car-details-hob', true );
	$used_car_details_sink = get_post_meta( $post->ID, 'used-car-details-sink', true );
	$used_car_details_toilet = get_post_meta( $post->ID, 'used-car-details-toilet', true );
	$used_car_details_tv = get_post_meta( $post->ID, 'used-car-details-tv', true );
	$used_car_details_isofix = get_post_meta( $post->ID, 'used-car-details-isofix', true );
	$used_car_details_awning = get_post_meta( $post->ID, 'used-car-details-awning', true );
	$used_car_details_rear_camera = get_post_meta( $post->ID, 'used-car-details-rear-camera', true );
	$used_car_details_pets = get_post_meta( $post->ID, 'used-car-details-pets', true );
	$used_car_details_id = get_post_meta( $post->ID, 'used-car-details-id', true );
	$used_car_details_video = get_post_meta( $post->ID, 'used-car-details-video', true );
?>

<div id="content">
	<?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    	<div class="post_content mybooking-used-cars mybooking-used-cars_post">
    		<div class="mb-container" tabindex="-1">

					<!-- The header -->

					<div class="mb-row">
						<div class="mb-col-md-12">
							<?php echo used_cars_breadcrumbs(); ?>
							<?php if ( empty( get_the_title() ) ) { ?>

								<!-- The product no name -->
								<h1 class="mybooking-used-cars_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>

								<!-- The product name -->
								<h1 class="mybooking-used-cars_post-header">
									<?php echo esc_html( $used_car_details_brand ) ?> <?php echo esc_html( $used_car_details_model )?>

                  <!-- The price -->
                  <span>
                    <?php if ( $used_car_details_price !='' ) {  ?>
                      <div class="mybooking-used-cars_price">
                        <?php echo esc_html( $used_car_details_price ) ?> €
                      </div>
                    <?php } ?>
                  </span>
								</h1>
							<?php } ?>

							<div class="mybooking-used-cars_post-subheader">

								<!-- The characteristics -->
								<div class="mybooking-used-cars_details">
									<?php if ( $used_car_details_places !='' ) {  ?>
										<span class="mybooking-used-cars_characteristic">
											<img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/places.svg'; ?>">
											<?php echo esc_html( $used_car_details_places ) ?> pax
										</span>
									<?php } ?>

									<?php if ( $used_car_details_beds !='' ) {  ?>
										<span class="mybooking-used-cars_characteristic">
											<img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/beds.svg'; ?>">
											<?php echo esc_html( $used_car_details_beds ) ?> pax
										</span>
									<?php } ?>

                  <?php if ( $used_car_details_toilet == 'yes' ) {  ?>
										<span class="mybooking-used-cars_characteristic">
											<img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/wc.svg'; ?>">
											<?php echo esc_html_x( 'Yes', 'used-car-single', 'mybooking-used-cars' ) ?>
										</span>
									<?php } ?>

                  <?php if ( $used_car_details_shower == 'yes' ) {  ?>
                    <span class="mybooking-used-cars_characteristic">
                      <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/shower.svg'; ?>">
                      <?php echo esc_html_x( 'Interior', 'used-car-single', 'mybooking-used-cars' ) ?>
                    </span>
                  <?php } ?>

                  <?php if ( $used_car_details_license !='' ) {  ?>
        						<span class="mybooking-used-cars_characteristic">
        							<img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/driving_license.svg'; ?>">
        							<?php echo esc_html( $used_car_details_license ) ?>
        						</span>
        					<?php } ?>

                  <?php if ( $used_car_details_solar_panels == 'yes' ) {  ?>
                    <span class="mybooking-used-cars_characteristic">
                      <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/solar-panels.svg'; ?>">
                      <?php echo esc_html_x( 'Yes', 'used-car-single', 'mybooking-used-cars' ) ?>
                    </span>
                  <?php } ?>

        					<?php if ( $used_car_details_pets == 'yes' ) {  ?>
        						<span class="mybooking-used-cars_characteristic">
        							<img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/pets.svg'; ?>">
        							<?php echo esc_html_x( 'Yes', 'used-car-single', 'mybooking-used-cars' ) ?>
        						</span>
        					<?php } ?>
        				</div>

                <!-- Category -->
                <div class="mybooking-used-cars_card-category">
                  <?php if ( get_post_type( get_the_ID() ) == 'camper' ) {
                    $used_car_taxonomy = get_the_terms( get_the_ID(), 'campers' );
                    if ( isset( $used_car_taxonomy ) && !empty( $used_car_taxonomy ) ) {
                      foreach ( $used_car_taxonomy as $used_car_tax ) { ?>
                        <span class="mybooking-used-cars_card-category-item"><?php echo esc_html( $used_car_tax->name ); ?></span>
                      <?php }
                    }
                  }?>
                </div>
							</div>
						</div>

						<!-- The body -->

						<div class="mb-col-md-8">

							<!-- The images -->
							<?php if( $used_car_details_photos_count !='' ) { ?>
								<div class="mybooking-used-cars_carousel mybooking-product-carousel-inner">
								<?php for( $i=0; $i<$used_car_details_photos_count; $i++ ) { ?>
									<div class="mybooking-carousel-item">
  									<?php
  									    $used_car_photo = wp_get_attachment_image(
  											$used_car_details_photos_url_array[$i],
  											'full',
  											false,
  											['src', 'alt', 'class' => 'mybooking-used-cars_carousel-img']
  										);
  										echo wp_kses_post( $used_car_photo )
                    ?>
									</div>
								<?php } ?>
								</div>
							<?php } ?>

							<!-- The content -->
							<div class="mybooking-used-cars_entry-content entry-content">
								<?php the_content(); ?>
							</div>

              <!-- The video -->
              <?php if ( $used_car_details_video !='' ) {  ?>
                <div class="mybooking-used-cars_video">
                  <?php echo wp_oembed_get( $used_car_details_video ); ?>
                </div>
              <?php } ?>

							<!-- Extras -->
              <div class="mb-col-md-12">
                <h2 class="mybooking-used-cars_section-title">
                  <?php echo esc_html_x( 'Extras', 'used-car-single', 'mybooking-used-cars' ) ?>
                </h2>

								<div class="mybooking-used-cars_details-list mb-list has-separator">
										<?php if ( $used_car_details_conditioned == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Air conditioning', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_conditioned == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_shower == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Shower', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_shower == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_hob == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Hob', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_hob == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_sink == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Sink', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_sink == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_toilet == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Toilet', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_toilet == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_tv == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'TV', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_tv == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_isofix == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'ISOFIX', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_isofix == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_awning == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Awning', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_awning == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $used_car_details_rear_camera == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Rear camera', 'used-car-single', 'mybooking-used-cars' ) ?>
												<?php if ( $used_car_details_rear_camera == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

								</div>
							</div>

							<!-- Details -->
							<div class="mb-col-md-12">
                <h2 class="mybooking-used-cars_section-title">
                  <?php echo esc_html_x( 'Details', 'used-car-single', 'mybooking-used-cars' ) ?>
                </h2>

								<div class="mybooking-used-cars_details-list mb-list has-separator">
									<?php if ( $used_car_details_lenght !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Vehicle length', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_lenght ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_width !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Vehicle width', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_width ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_height !='' ) {  ?>
					          <span class="mb-list-item">
					            <span><?php echo esc_html_x( 'Vehicle height', 'used-car-single', 'mybooking-used-cars' ) ?></span>
					            <?php echo esc_html( $used_car_details_height ) ?>
					          </span>
					        <?php } ?>

									<?php if ( $used_car_details_year !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Enrollement year', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_year ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_plate !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Plate number', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_plate ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_fuel !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Fuel type', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_fuel ) ?>
										</span>
									<?php } ?>

                  <?php if ( $used_car_details_gear !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Gear type', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_gear ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_engine !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Engine power', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_engine ) ?>
										</span>
									<?php } ?>

									<?php if ( $used_car_details_power !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Power supply', 'used-car-single', 'mybooking-used-cars' ) ?></span>
											<?php echo esc_html( $used_car_details_power ) ?>
										</span>
									<?php } ?>
								</div>
							</div>
						</div>

						<!-- The sidebar -->

						<div class="mb-col-md-4">
							<div class="mybooking-used-cars_sidebar">

								<!-- Widgets -->
								<?php if ( is_active_sidebar( 'sidebar-post' ) ) { ?>
									<div class="mybooking-used-cars_single-widget-area">
										 <?php dynamic_sidebar( 'sidebar-post' ); ?>
									</div>
								<?php } ?>

                <h2 class="mybooking-used-cars_section-title">
                  <?php echo esc_html_x( 'Book online', 'used-car-single', 'mybooking-used-cars' ) ?>
                </h2>

								<!-- Calendar or Form -->
								<?php if ( $used_car_details_id !='' ) {  ?>
									<div class="mybooking-used-cars_product-form mb-card">
										<?php echo do_shortcode( '[mybooking_rent_engine_product code="' . $used_car_details_id . '"]' ); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

    			<div class="mb-row">
    				<div class="mb-col-md-12">

							<!-- Link pages -->
          		<?php
          		wp_link_pages(
          			array(
          				'before' => '<div class="mybooking-entry-links">' . esc_html_x( 'Pages', 'pages_navigation', 'mybooking' ),
          				'after'  => '</div>',
          			)
          		);
          		?>

							<!-- Footer -->
    					<footer class="entry-footer">
    						<?php
    						   if (function_exists('mybooking_entry_footer') ):
    						     mybooking_entry_footer();
    						   endif;
    						?>
    					</footer>
    				</div>
    			</div>
    		</div>

    		<!-- Posts navigation -->
    		<?php
    		  if (function_exists('mybooking_post_nav') ):
    		     mybooking_post_nav();
    		  endif; ?>
    	</div>
    </article>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</div>

<?php get_footer();
