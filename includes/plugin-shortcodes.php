<?php
/**
*		Used Car Shortcodes
*  	-------------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking used cars Plugin
*   @since 1.0.3
*
*   @see https://wordpress.stackexchange.com/a/232879
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Register shortcodes
 *
 */
function register_used_cars_shortcodes() {
  add_shortcode( 'mybooking_used_cars_loop', 'mybooking_used_cars_shortcode' );
}
add_action( 'init', 'register_used_cars_shortcodes' );


/**
 * campers shortcode callback
 *
 */
function mybooking_used_cars_shortcode() {

    ob_start();
    global $wp_query,
           $post;

    $used_cars_loop = new WP_Query( array(
        'posts_per_page'    => 6,
        'post_type'         => 'used-car',
    ) );

    if( ! $used_cars_loop->have_posts() ) {
        return false;
    } ?>

    <div class="mb-shortcode mybooking-used-cars">
    	<div class="mb-container">
    		<div class="mb-row">
    			<div class="mb-col-md-12">
            <div class="mybooking-used-cars_grid">

              <?php while( $used_cars_loop->have_posts() ) {
                  $used_cars_loop->the_post();
                  include('templates/loop-part.php');
              } ?>

            </div>
          </div>
        </div>
      </div>
    </div>

  <?php  wp_reset_postdata();
  return ob_get_clean();
}
