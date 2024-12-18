<?php
/**
*		Used cars LOOP PART
*  	---------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking used cars Plugin
*   @since 1.0.3
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<!-- Gets custom fields data -->
<?php
	$used_car_details_brand = get_post_meta( $post->ID, 'used-car-details-brand', true );
	$used_car_details_model = get_post_meta( $post->ID, 'used-car-details-model', true );
  // Get the terms of the taxonomy
  $brand_term = get_term( $used_car_details_brand, 'brand' );
  $model_term = get_term( $used_car_details_model, 'brand' );
  // Get the values of the taxonomy
  $used_car_details_brand = $brand_term ? $brand_term->name : ''; 
  $used_car_details_model = $model_term ? $model_term->name : '';
	$used_car_details_price = get_post_meta( $post->ID, 'used-car-details-price', true );
  $used_car_details_year = get_post_meta( $post->ID, 'used-car-details-year', true );
  $used_car_details_kms = get_post_meta( $post->ID, 'used-car-details-kms', true );
  $used_car_details_engine = get_post_meta( $post->ID, 'used-car-details-engine', true );
  $used_car_details_gear = get_post_meta( $post->ID, 'used-car-details-gear', true );
  $used_car_details_fuel = get_post_meta( $post->ID, 'used-car-details-fuel', true );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  <?php $mybooking_permalink = get_permalink(); ?>

  <!-- Card content -->
  <div class="mybooking-used-cars_card">

    <div class="mybooking-used-cars_card-image">
      <div class="mybooking-used-cars_card-image-container">
        <?php the_post_thumbnail(); ?>
      </div>
    </div>

    <div class="mybooking-used-cars_card-body">

      <?php if ( $used_car_details_brand !='' || $used_car_details_model !='' ) {  ?>
        <div class="mybooking-used-cars_card-title">
          <?php echo esc_html( $used_car_details_brand ) ?> <?php echo esc_html( $used_car_details_model ) ?>
        </div>
      <?php } ?>

      <?php if ( $used_car_details_price !='' ) {  ?>
        <div class="mybooking-used-cars_card-price">
          <?php echo esc_html( number_format($used_car_details_price, 0, ',', '.') ) ?> €
        </div>
      <?php } ?>

      <!-- Details -->
      <div class="mybooking-used-car_details">
        <?php if ( $used_car_details_year !='' ) {  ?>
          <span class="badge badge-light">
           <?php echo esc_html( $used_car_details_year ) ?>
          </span>
        <?php } ?>  
        <?php if ( $used_car_details_kms !='' ) {  ?>
          <span class="badge badge-light">
            <?php echo esc_html( number_format($used_car_details_kms, 0, ',', '.') ) ?> km
          </span>
        <?php } ?>
        <?php if ( $used_car_details_engine !='' ) {  ?>
          <span class="badge badge-light">
            <?php echo esc_html( $used_car_details_engine ) ?> CV
          </span>
        <?php } ?>
        <?php if ( $used_car_details_gear !='' ) {  ?>
          <span class="badge badge-light">
            <?php if ( $used_car_details_gear == 'manual' ) { ?>
              <?php echo esc_html_x('Manual', 'used-car-archive', 'mybooking-used-cars') ?>
            <?php } else { ?>
              <?php echo esc_html_x('Automatic', 'used-car-archive', 'mybooking-used-cars') ?>
            <?php } ?>
          </span>
        <?php } ?>
        <?php if ( $used_car_details_fuel !='' ) {  ?>
          <span class="badge badge-light">
            <?php 
            switch ($used_car_details_fuel) {
              case 'petrol':
                echo esc_html_x('Petrol', 'used-car-archive', 'mybooking-used-cars');
                break;
              case 'diesel':
                echo esc_html_x('Diesel', 'used-car-archive', 'mybooking-used-cars');
                break;
              case 'electric':
                echo esc_html_x('Electric', 'used-car-archive', 'mybooking-used-cars');
                break;
              case 'hybrid':
                echo esc_html_x('Hybrid', 'used-car-archive', 'mybooking-used-cars');
                break;
              default:
                echo esc_html($used_car_details_fuel);
            }
            ?>
          </span>
        <?php } ?>

      </div>

      <!-- Read more -->
      <a class="button btn btn-choose-product mybooking-used-cars_btn-book" role="button" href="<?php the_permalink(); ?>"><?php echo esc_html_x('Details', 'used-car-archive', 'mybooking-used-cars') ?></a>
    </div>
  </div>
</article>
