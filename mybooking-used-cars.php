<?php

/**
 * MYBOOKING CAMPERS PLUGIN
 * ------------------------
 *
 * @wordpress-plugin
 * Plugin Name:       Mybooking Used Cars
 * Plugin URI:        https://mybooking.es
 * Description:       Simple plugin to create a Custom Post Type to show used cars pages
 * Version:           1.0.0
 * Author:            Mybooking Team
 * Author URI:        https://mybooking.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mybooking-used-cars
 * Domain Path:       /languages
 *
 * @link              https://mybooking.es
 * @since             1.0.0
 * @package           Mybooking Used Cars
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Enqueue styles
 *
 * @since 1.0.0
 */
function mybooking_used_cars_styles( ) {
	wp_register_style(
		'mybooking-used-cars-styles',
		plugins_url( '/style.css', __FILE__ )
	);
	wp_enqueue_style(
	 'mybooking-used-cars-styles',
	 plugin_dir_url( __FILE__ ) . 'style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'mybooking_used_cars_styles' );

/**
 * Loads textdomain
 *
 * @since 1.0.0
 */
function load_mybooking_used_cars_textdomain() {
    load_plugin_textdomain( 'mybooking-used-cars', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'load_mybooking_used_cars_textdomain' );

/**
 * Includes used-cars post type
 *
 * @since 1.0.0
 */
include_once('includes/used-car-post-type.php');


/**
 * Includes used-cars meta boxes
 *
 * @since 1.0.0
 */
include_once('includes/used-car-metaboxes.php');


/**
 * Includes plugin breadcrumbs
 *
 * @since 1.0.0
 */
include_once('includes/plugin-breadcrumbs.php');


/**
 * Includes plugin shortcodes
 *
 * @since 1.0.3
 */
include_once('includes/plugin-shortcodes.php');


/**
 * Add class 'mybooking-product' to custom post type
 *
 * @since 1.0.1
 */
function mybooking_used_cars_body_class ( $classes ) {

    if ( 'used-car' == get_post_type() ):
      $classes[] = 'mybooking-contact-widget';
    endif;

    return $classes;

}
add_filter( 'body_class', 'mybooking_used_cars_body_class' );


/**
 * Create sidebars for templates
 *
 * @since 1.0.2
 */
function mybooking_used_cars_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Used cars Archive Top', 'mybooking-used-cars' ),
        'id'            => 'sidebar-top',
        'description'   => __( 'Widgets in this area will be shown on campers archives page.', 'mybooking-used-cars' ),
        'before_widget' => '<div id="%1$s" class="mybooking-used-cars_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-used-cars_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Used cars Archive Bottom', 'mybooking-used-cars' ),
        'id'            => 'sidebar-bottom',
        'description'   => __( 'Widgets in this area will be shown on campers archives page.', 'mybooking-used-cars' ),
        'before_widget' => '<div id="%1$s" class="mybooking-used-cars_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-used-cars_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Used cars Post', 'mybooking-used-cars' ),
        'id'            => 'sidebar-post',
        'description'   => __( 'Widgets in this area will be shown on used cars single page.', 'mybooking-used-cars' ),
        'before_widget' => '<div id="%1$s" class="mybooking-used-cars_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-used-cars_widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mybooking_used_cars_sidebars' );

/**
 * Append admin scripts
*/
function mybooking_used_cars_enqueue_admin_scripts( $hook ) {
    // Cargar solo en la pantalla de edición de posts
    if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
        return;
    }

    wp_enqueue_script(
        'mybooking-used-car-js',
        plugin_dir_url( __FILE__ ) . 'includes/assets/js/mybooking-used-cars-metabox.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );

    // Pasar datos a JavaScript
    wp_localize_script( 'mybooking-used-car-js', 'mybookingUsedCar', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'admin_enqueue_scripts', 'mybooking_used_cars_enqueue_admin_scripts' );

function mybooking_used_cars_enqueue_validation_script( $hook ) {
    if ( $hook === 'post.php' || $hook === 'post-new.php' ) {
        // Asegúrate de que jQuery está cargado
        wp_enqueue_script( 'jquery' );

        // Carga tu script de validación
        wp_enqueue_script(
            'mybooking-used-car-validation',
            plugin_dir_url( __FILE__ ) . 'includes/assets/js/mybooking-used-cars-validation.js',
            array( 'jquery' ),
            '1.0',
            true
        );

        // Agregar un estilo para los campos inválidos
        wp_add_inline_style(
            'wp-admin',
            '
            .invalid-field {
                border: 2px solid red;
                background-color: #ffe6e6;
            }
            .error-message {
                color: red;
                font-size: 12px;
                margin-top: 4px;
            }
            '
        );
    }
}
add_action( 'admin_enqueue_scripts', 'mybooking_used_cars_enqueue_validation_script' );

/**
* AJAX to retrieve brand models 
*/
function mybooking_get_models_ajax() {
    // Verificar que la solicitud tiene la marca
    if ( ! isset( $_POST['brand_id'] ) ) {
        wp_send_json_error( 'Brand ID is required' );
    }

    $brand_id = intval( $_POST['brand_id'] );

    // Obtener los términos hijos (modelos) de la marca seleccionada
    $models = get_terms( array(
        'taxonomy'   => 'brand',
        'hide_empty' => false,
        'parent'     => $brand_id,
    ) );

    if ( is_wp_error( $models ) ) {
        wp_send_json_error( $models->get_error_message() );
    }

    // Preparar los datos para enviarlos al cliente
    $models_data = array();
    foreach ( $models as $model ) {
        $models_data[] = array(
            'id'   => $model->term_id,
            'name' => $model->name,
        );
    }

    wp_send_json_success( $models_data );
}
add_action( 'wp_ajax_mybooking_get_models', 'mybooking_get_models_ajax' );

/**
 * Enqueue scripts and styles for the used car gallery
 */
function mybooking_used_car_enqueue_gallery() {
    if (is_singular('used-car')) { // Asegúrate de que solo se cargue en la página de detalle
        // Load CSS
        wp_enqueue_style('mybooking-used-car-gallery-css', plugin_dir_url( __FILE__ ) . '/assets/css/mybooking-used-cars-gallery.css');
        
        // Load JS
        wp_enqueue_script('mybooking-used-car-gallery-js', plugin_dir_url( __FILE__ ) . '/assets/js/mybooking-used-cars-gallery.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'mybooking_used_car_enqueue_gallery');

/**
 * Enqueue scripts and styles for the brand taxonomy
 */
function mybooking_enqueue_taxonomy_scripts($hook) {
    // Carga scripts sólo en la página de taxonomías
    $screen = get_current_screen();
    if ($screen && $screen->taxonomy === 'brand' && $screen->base === 'edit-tags') {
        // Encola el archivo JS
        wp_enqueue_script(
            'brand-taxonomy-js', // Handle único
            plugin_dir_url( __FILE__ ) . 'includes/assets/js/mybooking-used-cars-brand-taxonomy.js', // Ruta del archivo
            ['jquery'], // Dependencias
            '1.0.0', // Versión
            true // Cargar en el footer
        );
    }
}
add_action('admin_enqueue_scripts', 'mybooking_enqueue_taxonomy_scripts');
