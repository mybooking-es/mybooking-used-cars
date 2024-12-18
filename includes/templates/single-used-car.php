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
  $used_car_details_engine = get_post_meta( $post->ID, 'used-car-details-engine', true );
  $used_car_details_gear = get_post_meta( $post->ID, 'used-car-details-gear', true );
  $used_car_details_fuel = get_post_meta( $post->ID, 'used-car-details-fuel', true );
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
						</div>
					</div>

					<div class="mb-row">
						<!-- The body -->

						<div class="mb-col-md-7">

							<!-- The images -->
							<?php if( $used_car_details_photos_count !='' ) { ?>
									<div class="mybooking-used-cars-carousel-container">
											<!-- Imagen principal -->
											<div class="mybooking-used-cars-main-image">
													<?php
															// Obtener la imagen principal (tamaño completo)
															$used_car_main_image = wp_get_attachment_image(
																	$used_car_details_photos_url_array[0], // ID de la imagen
																	'full', // Tamaño completo de la imagen
																	false, // No se necesita el link
																	['class' => 'mybooking-used-cars_carousel-img', 'alt' => 'Imagen principal del coche']
															);
															echo wp_kses_post($used_car_main_image); // Mostrar la imagen principal
													?>
											</div>

											<!-- Carrusel de miniaturas (thumbnails) -->
											<div class="mybooking-used-cars_carousel mybooking-product-carousel-inner">
													<?php for( $i=0; $i<$used_car_details_photos_count; $i++ ) { ?>
															<div class="mybooking-used-cars_carousel-item">
																	<?php
																			// Obtener la miniatura de la imagen (tamaño 'thumbnail')
																			$used_car_thumbnail = wp_get_attachment_image(
																					$used_car_details_photos_url_array[$i], // ID de la imagen
																					'medium', // Tamaño de la miniatura
																					false, // No se necesita el link
																					[
																							'class' => 'mybooking-used-cars_carousel-thumbnail',
																							'alt' => 'Miniatura del coche', 
																							'data-full-size' => wp_get_attachment_url($used_car_details_photos_url_array[$i]) // URL de la imagen completa
																					]
																			);
																			echo wp_kses_post($used_car_thumbnail); // Mostrar miniatura
																	?>
															</div>
													<?php } ?>
											</div>
									</div>
							<?php } ?>


							<!-- The content -->
							<div class="mybooking-used-cars_entry-content entry-content">
								<?php the_content(); ?>
							</div>

						</div>

						<!-- The sidebar -->

						<div class="mb-col-md-5">
							<div class="mybooking-used-cars_sidebar">

								<!-- The product name -->
								<h1 class="mybooking-used-cars_post-header">
									<?php echo esc_html( $used_car_details_brand ) ?> <?php echo esc_html( $used_car_details_model )?>
								</h1>

								<?php include 'used-car-details.php'; ?>		

								<!-- The price -->
								<?php if ( $used_car_details_price !='' ) {  ?>
									<div class="mybooking-used-cars_card-price-single_price">
										<?php echo esc_html( number_format($used_car_details_price, 0, ',', '.')  ) ?> €
									</div>
								<?php } ?>
                  
								<br>

								<!-- Calendar or Form -->
								<h2 class="mybooking-used-cars_post-subheader">
									<?php echo esc_html_x('Contact', 'used-car-archive', 'mybooking-used-cars'); ?>
								</h2>								 

								<!-- Widgets -->
								<?php if ( is_active_sidebar( 'sidebar-post' ) ) { ?>
									<div class="mybooking-used-cars_single-widget-area">
										 <?php dynamic_sidebar( 'sidebar-post' ); ?>
									</div>
									<br>
								<?php } ?>

								<div class="mybooking-used-cars_product-form mb-card">
									<?php echo do_shortcode( '[mybooking_contact]' ); ?>
								</div>


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
