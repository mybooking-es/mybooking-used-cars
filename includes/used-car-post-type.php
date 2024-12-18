<?php

/**
 * Register Mybooking Motorhome Custom Post Type
 *
 * @since 1.0.1
 */
function mybooking_used_car() {

	$labels = array(
		'name'                  => _x( 'Used cars', 'Post Type General Name', 'mybooking-used-cars' ),
		'singular_name'         => _x( 'Used cars', 'Post Type Singular Name', 'mybooking-used-cars' ),
		'menu_name'             => __( 'Used cars', 'mybooking-used-cars' ),
		'name_admin_bar'        => __( 'Used cars', 'mybooking-used-cars' ),
		'archives'              => __( 'Used car Archives', 'mybooking-used-cars' ),
		'attributes'            => __( 'Used car Attributes', 'mybooking-used-cars' ),
		'parent_item_colon'     => __( 'Parent used car:', 'mybooking-used-cars' ),
		'all_items'             => __( 'All used cars', 'mybooking-used-cars' ),
		'add_new_item'          => __( 'Add New used car', 'mybooking-used-cars' ),
		'add_new'               => __( 'Add New', 'mybooking-used-cars' ),
		'new_item'              => __( 'New used car', 'mybooking-used-cars' ),
		'edit_item'             => __( 'Edit used car', 'mybooking-used-cars' ),
		'update_item'           => __( 'Update used car', 'mybooking-used-cars' ),
		'view_item'             => __( 'View used car', 'mybooking-used-cars' ),
		'view_items'            => __( 'View used car', 'mybooking-used-cars' ),
		'search_items'          => __( 'Search used car', 'mybooking-used-cars' ),
		'not_found'             => __( 'Not found', 'mybooking-used-cars' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mybooking-used-cars' ),
		'featured_image'        => __( 'Used car Catalog Image', 'mybooking-used-cars' ),
		'set_featured_image'    => __( 'Set Used car image', 'mybooking-used-cars' ),
		'remove_featured_image' => __( 'Remove Used car image', 'mybooking-used-cars' ),
		'use_featured_image'    => __( 'Use as Used car image', 'mybooking-used-cars' ),
		'insert_into_item'      => __( 'Insert into Used car', 'mybooking-used-cars' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Used car', 'mybooking-used-cars' ),
		'items_list'            => __( 'Used car list', 'mybooking-used-cars' ),
		'items_list_navigation' => __( 'Used list navigation', 'mybooking-used-cars' ),
		'filter_items_list'     => __( 'Filter Used List', 'mybooking-used-cars' ),
	);
	$rewrite = array(
		'slug'                  => __( 'used-car', 'mybooking-used-cars' ),
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Used cars', 'mybooking-used-cars' ),
		'description'           => __( 'Mybooking used cars.', 'mybooking-used-cars' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-car',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'used-car', $args );

}
add_action( 'init', 'mybooking_used_car', 0 );

// ------ Brands

/**
 * Register brands taxonomy for used cars
 *
 * @since 1.0.0
 */
function mybooking_register_taxonomy_brands() {
    register_taxonomy(
        'brand',
        'used-car',
        [
            'labels' => [
                'name' => __( 'Brands and models', 'mybooking-used-cars' ),
                'singular_name' => __( 'Brand', 'mybooking-used-cars' ),
                'search_items' => __( 'Search brands', 'mybooking-used-cars' ), 
                'all_items' => __( 'All brands', 'mybooking-used-cars' ), 
                'edit_item' => __( 'Edit brand', 'mybooking-used-cars' ), 
                'update_item' => __( 'Update brand', 'mybooking-used-cars' ), 
                'add_new_item' => __( 'Add brand', 'mybooking-used-cars' ),
                'new_item_name' => __( 'New brand', 'mybooking-used-cars' ),
            ],
            'hierarchical' => true, // Work like categories
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true, 
            'rewrite' => ['slug' => 'brand'],
        ]
    );
}
add_action( 'init', 'mybooking_register_taxonomy_brands', 0 );

// Remove description field from brand taxonomy
function mybooking_remove_description_field_add($taxonomy) {
    if ($taxonomy === 'brand') {
        // Usamos CSS para ocultar el campo "Descripción" solo en esta taxonomía
        ?>
        <style>
            .term-description-wrap {
                display: none;
            }
						.term-parent-wrap {
								display: none;
						}
        </style>
				<script>
					jQuery(document).ready(function($) {
						$('div.form-field.term-parent-wrap').remove();
					});
				</script>
        <?php
    }
}
add_action('brand_add_form_fields', 'mybooking_remove_description_field_add');

// Remove description field from brand taxonomy (edit field)
function mybooking_remove_description_field_edit($term, $taxonomy) {
    if ($taxonomy === 'brand') {
        ?>
        <style>
            .term-description-wrap {
                display: none;
            }
            .term-parent-wrap {
                display: none;
            }						
        </style>
        <?php
    }
}
add_action('brand_edit_form_fields', 'mybooking_remove_description_field_edit', 10, 2);

// Remove description and posts columns from brand taxonomy
function mybooking_remove_description_column($columns) {
    if (isset($columns['description'])) {
        unset($columns['description']); // Remove the 'Description' column
    }
		if (isset($columns['posts'])) {
			unset($columns['posts']); // Remove the 'Posts' column
		}
		// To resolve when creating a model inside a brand
		if (!isset($_GET['brand'])) {
			if (isset($columns['models'])) {
				unset($columns['models']); // Remove the 'Models' column
			}
		}
    return $columns;
}
add_filter('manage_edit-brand_columns', 'mybooking_remove_description_column');

// Add models link to brand taxonomy columns
function mybooking_add_brand_column($columns) {
		if ('POST' !== $_SERVER['REQUEST_METHOD'] && !defined('DOING_AJAX')) {
			if (!isset($_GET['brand'])) {
				$columns['models'] = __('Models', 'mybooking-used-cars'); 
			}
		}
    return $columns;
}
add_filter('manage_edit-brand_columns', 'mybooking_add_brand_column');

// Paso 2: Rellenar la columna con un enlace a la lista de modelos de la marca
function mybooking_manage_brand_column($content, $column_name, $term_id) {
		if ('POST' !== $_SERVER['REQUEST_METHOD'] && !defined('DOING_AJAX')) {
			if (!isset($_GET['brand'])) {
				if ($column_name == 'models') {
						// Crear el enlace a la lista de modelos filtrados por la marca actual
						$url = admin_url('edit-tags.php?taxonomy=brand&post_type=used-car&brand=' . $term_id);
						$content = '<a href="' . esc_url($url) . '">' . __('View Models', 'mybooking-used-cars') . '</a>';
				}
			}
		}
    return $content;
}
add_filter('manage_brand_custom_column', 'mybooking_manage_brand_column', 10, 3);

// Filter models by brand
function mybooking_filter_models_by_brand($query) {
    // Comprobar si estamos en el área de administración de términos y si hay un parámetro de marca
    if (is_admin() && isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'brand') {
			  // Obtener el parámetro 'brand' de la URL
        $brand_id = isset($_GET['brand']) ? intval($_GET['brand']) : null;

        // Si hay un 'brand' en la URL, filtramos por ese 'parent'
        if ($brand_id) {
					$query->query_vars['parent'] = $brand_id; // Only show terms with the specified parent
				} else {
					$query->query_vars['parent'] = 0; // Only show top-level terms
        }					
				$query->query_vars['hide_empty'] = false;
				$query->query_vars['hierarchical'] = false;

        // Depuración: Verificar los términos devueltos por la consulta
				add_filter('get_terms', function($terms, $taxonomies, $args) {
						foreach ($terms as $term) {
                $term->parent = 0; // Force 0 so they can be represented as top-level terms
            }
            return $terms;
        }, 10, 3);
		}
}
add_action('pre_get_terms', 'mybooking_filter_models_by_brand');

// Add brand field to model form
function mybooking_add_brand_field_to_model_form($term) {
    if (isset($_GET['brand']) && $_GET['brand']) {
        $brand_id = intval($_GET['brand']);
        echo '<input type="hidden" name="parent" value="' . $brand_id . '" />';
    }
}
add_action('brand_add_form_fields', 'mybooking_add_brand_field_to_model_form');
add_action('brand_edit_form_fields', 'mybooking_add_brand_field_to_model_form');

// -- Change the title of the brand taxonomy
function mybooking_modify_taxonomy_labels($translation, $text, $domain) {
    // Verificar si estamos traduciendo el label de 'Add brand'
    if ($domain === 'mybooking-used-cars' && $text === 'Add brand') {
        // Comprobar si el parámetro 'brand' está presente en la URL
        if (isset($_GET['brand']) && !empty($_GET['brand'])) {
            // Si hay un parámetro 'brand', cambiamos 'Add brand' por 'Add model'
            return __('Add model', 'mybooking-used-cars');
        }
    }

    // Devolver el texto original si no es necesario cambiarlo
    return $translation;
}
add_filter('gettext', 'mybooking_modify_taxonomy_labels', 10, 3);

// Show parent name
function mybooking_display_parent_term_name() {
    // Verificar si estamos en la página de edición de términos de la taxonomía 'brand'
    if (isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'brand' && isset($_GET['brand'])) {
        $term_id = (int) $_GET['brand'];

        // Obtener el término actual
        $term = get_term($term_id, 'brand');

        if ($term) {
            // Mostrar el nombre del término padre en la interfaz de administración
            if (!is_wp_error($term)) {
                echo '<div class="notice notice-info is-dismissible">';
                echo '<p><strong>' . esc_html($term->name) . '</strong></p>';
                echo '</div>';
            }
        }
    }
}
add_action('admin_notices', 'mybooking_display_parent_term_name');



// --------- Templates for CPT

/**
 * Add templates for new taxonomies
 *
 * @since 1.0.0
 */

// used car
function mybooking_used_car_single_template( $single_used_car_template ){
 	global $post;

	if ( $post->post_type == 'used-car' ) {
	  $single_used_car_template = plugin_dir_path(__FILE__) . 'templates/single-used-car.php';
	}
	return $single_used_car_template;
}
add_filter( 'single_template','mybooking_used_car_single_template' );

function mybooking_used_car_archives_template( $archive_used_car_template ){
  global $post;

  if ( $post->post_type == 'used-car' ) {
    $archive_used_car_template = plugin_dir_path(__FILE__) . 'templates/archives-used-car.php';
  }
  return $archive_used_car_template;
}
add_filter( 'archive_template','mybooking_used_car_archives_template' );

function mybooking_used_car_posts_per_page($query) {
    // Verifica si estamos en el backend (admin) o si la consulta es para el CPT 'used-car'
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('used-car')) {
        $query->set('posts_per_page', 15);
    }
}
add_action('pre_get_posts', 'mybooking_used_car_posts_per_page');

function mybooking_used_car_change_order($query) {
    // Asegúrate de que estamos en el archivo de archivo del CPT 'used-car' y que no estamos en el admin
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('used-car')) {
        // Order by price (metabox 'used-car-details-price')
        $query->set('meta_key', 'used-car-details-price');
        $query->set('orderby', 'meta_value_num'); 
        $query->set('order', 'ASC');  // Asc order
    }
}
add_action('pre_get_posts', 'mybooking_used_car_change_order');