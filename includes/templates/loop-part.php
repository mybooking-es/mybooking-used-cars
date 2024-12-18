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
	$used_car_details_places = get_post_meta( $post->ID, 'used-car-details-places', true );
	$used_car_details_beds = get_post_meta( $post->ID, 'used-car-details-beds', true );
	$used_car_details_license = get_post_meta( $post->ID, 'used-car-details-license', true );
	$used_car_details_shower = get_post_meta( $post->ID, 'used-car-details-shower', true );
	$used_car_details_pets = get_post_meta( $post->ID, 'used-car-details-pets', true );
	$used_car_details_toilet = get_post_meta( $post->ID, 'used-car-details-toilet', true );
	$used_car_details_solar_panels = get_post_meta( $post->ID, 'used-car-details-solar-panels', true );
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

      <!-- Categories -->

      <?php if ( get_post_type( get_the_ID() ) == 'camper' ) { ?>
        <?php $used_car_taxonomy = get_the_terms( get_the_ID(), 'campers' ); ?>
        <?php if ( isset( $used_car_taxonomy ) && !empty( $used_car_taxonomy ) ) { ?>
          <div class="mybooking-used-cars_card-category">
            <?php foreach ( $used_car_taxonomy as $used_car_tax ) { ?>
              <span class="mybooking-used-cars_card-category-item"><?php echo esc_html( $used_car_tax->name ); ?></span>
            <?php } ?>
          </div>
        <?php } ?>
      <?php }?>


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
      </div>

      <div class="mybooking-used-cars_details">
        <?php if ( $used_car_details_places !='' ) {  ?>
          <span class="mybooking-used-cars_characteristic">
            <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/places.svg'; ?>">
            <?php echo esc_html( $used_car_details_places ) ?>
          </span>
        <?php } ?>

        <?php if ( $used_car_details_beds !='' ) {  ?>
          <span class="mybooking-used-cars_characteristic">
            <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/beds.svg'; ?>">
            <?php echo esc_html( $used_car_details_beds ) ?>
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

        <?php if ( $used_car_details_pets == 'yes' ) {  ?>
          <span class="mybooking-used-cars_characteristic">
            <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/pets.svg'; ?>">
            <?php echo esc_html_x( 'Yes', 'used-car-single', 'mybooking-used-cars' ) ?>
          </span>
        <?php } ?>

        <?php if ( $used_car_details_solar_panels == 'yes' ) {  ?>
          <span class="mybooking-used-cars_characteristic">
            <img class="mybooking-used-cars_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/solar-panels.svg'; ?>">
            <?php echo esc_html_x( 'Yes', 'used-car-single', 'mybooking-used-cars' ) ?>
          </span>
        <?php } ?>
      </div>

      <!-- Read more -->
      <a class="button btn btn-choose-product mybooking-used-cars_btn-book" role="button" href="<?php the_permalink(); ?>"><?php echo esc_html_x('Details', 'used-car-archive', 'mybooking-used-cars') ?></a>
    </div>
  </div>
</article>
