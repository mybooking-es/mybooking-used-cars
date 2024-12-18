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

							<!-- Details -->
							<div class="mb-col-md-12">
                <h2 class="mybooking-used-cars_section-title">
                  <?php echo esc_html_x( 'Details', 'used-car-single', 'mybooking-used-cars' ) ?>
                </h2>
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
