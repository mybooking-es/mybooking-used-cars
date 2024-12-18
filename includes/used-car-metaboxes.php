<?php
/**
 * Register meta boxes for Motorhome Custom Post Type
 *
 * @since 1.0.1
 */

  /* Add metabox
  */
  function add_used_car_metabox() {

    $screens = [ 'used-car' ];
    foreach ( $screens as $screen ) {
      add_meta_box(
        'used-car-details',                                                   // Unique ID
        _x( 'Used car Details', 'used-car-metabox', 'mybooking-used-cars' ),   // Box title
        'used_car_details_box',                                               // Content callback, must be of type callable
        $screen,                                                            // Post type
        'normal',                                                           // Position; normal, advanced or side (CHANGED to normal because advanced duplicates gallery fields)
        'core',                                                             // Priority
      );
    }

  }

  /* 
   * Fields editor
  */
  function used_car_details_box( $used_car_data ) {

      // Gallery data
      $used_car_gallery_data = get_post_meta( $used_car_data->ID, 'used-car-details-gallery-data', true );
      ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label><?php echo esc_html_x( 'Image gallery', 'used-car-single', 'mybooking-used-cars' ) ?></label>
            </th>
            <td style="width: 45%;">
              <div class="gallery_wrapper">
                <div id="img_box_container">
                  <?php
                    if ( isset( $used_car_gallery_data['image_url'] ) ){
                      for( $i = 0; $i < count( $used_car_gallery_data['image_url'] ); $i++ ){
                        $used_car_gallery_item_src =  wp_get_attachment_image_src($used_car_gallery_data['image_url'][$i],
                                                                                'medium'
                                                                                );
                        if (!empty($used_car_gallery_item_src)) {
                      ?>
                        <div class="gallery_single_row dolu">
                          <div class="gallery_area image_container ">
                            <img class="gallery_img_img" src="<?php esc_html_e( $used_car_gallery_item_src[0] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                            <input type="hidden"
                                class="meta_image_url"
                                name="used-car-details-gallery[image_url][]"
                                value="<?php esc_html_e( $used_car_gallery_data['image_url'][$i] ); ?>"
                              />
                          </div>
                          <div class="gallery_area">
                            <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                          </div>
                          <div class="clear">
                          </div>
                        </div>
                      <?php
                        }
                      }
                    }
                  ?>
                </div>
                <!-- Prepare new image -->
                <div style="display:none" id="master_box">
                  <div class="gallery_single_row">
                    <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                      <input class="meta_image_url" value="" type="hidden" name="used-car-details-gallery[image_url][]" />
                    </div>
                    <div class="gallery_area">
                      <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <div id="add_gallery_single_row">
                  <button class="button add" type="button" onclick="open_media_uploader_image_plus();" title="Add image"/>
                    +
                  </button>
                </div>
              </div>
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Add multiple images from your media library to create a carousel. Click and drag to change the order.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
            </td>
          </tr>
        </tbody>
      </table>
    
    <!-- Price -->
    <?php
      $used_car_details_price = get_post_meta( $used_car_data->ID, 'used-car-details-price', true );
      ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="used-car-details-price"><?php echo esc_html_x( 'Selling price', 'used-car-single', 'mybooking-used-cars' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="used-car-details-price"
              value="<?php echo esc_attr( $used_car_details_price ); ?>"
              id="used-car-details-price"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Selling price.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
          </td>
        </tr>
      </table>

    <!-- Brand and model -->
    <?php
      $selected_brand = get_post_meta( $used_car_data->ID, 'used-car-details-brand', true );
      $selected_model = get_post_meta( $used_car_data->ID, 'used-car-details-model', true );

      // Get brands
      $brands = get_terms( array(
          'taxonomy'   => 'brand',
          'hide_empty' => false,
          'parent'     => 0, // Only parent terms
      ) );

      $models = array();
      if ( $selected_brand ) {
          $models = get_terms( array(
              'taxonomy'   => 'brand',
              'hide_empty' => false,
              'parent'     => $selected_brand,
          ) );
      }
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="used-car-details-brand"><?php esc_html_e( 'Brand', 'mybooking-used-cars' ); ?></label>
                </th>
                <td style="width: 45%;">
                    <select
                        name="used-car-details-brand"
                        id="used-car-details-brand"
                        class="components-select-control__input"
                        style="width: 100%"
                    >
                        <option value=""><?php esc_html_e( 'Select a brand', 'mybooking-used-cars' ); ?></option>
                        <?php foreach ( $brands as $brand ) : ?>
                            <option value="<?php echo esc_attr( $brand->term_id ); ?>"
                                <?php selected( $selected_brand, $brand->term_id ); ?>>
                                <?php echo esc_html( $brand->name ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 45%;">
                  <p class="description"><?php echo esc_html_x( 'The vehicle mark.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
                </td>                
            </tr>
            <tr>
                <th scope="row">
                    <label for="used-car-details-model"><?php esc_html_e( 'Model', 'mybooking-used-cars' ); ?></label>
                </th>
                <td style="width: 45%;">
                    <select
                        name="used-car-details-model"
                        id="used-car-details-model"
                        class="components-select-control__input"
                        <?php echo empty( $selected_brand ) ? 'disabled' : ''; ?>
                        style="width: 100%"
                    >
                        <option value=""><?php esc_html_e( 'Select a model', 'mybooking-used-cars' ); ?></option>
                        <?php if ( ! empty( $models ) ) : ?>
                            <?php foreach ( $models as $model ) : ?>
                                <option value="<?php echo esc_attr( $model->term_id ); ?>"
                                    <?php selected( $selected_model, $model->term_id ); ?>>
                                    <?php echo esc_html( $model->name ); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 45%;">
                  <p class="description"><?php echo esc_html_x( 'The vehicle model.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
                </td>                 
            </tr>
        </tbody>
    </table>
    
    <!-- Year -->
    <?php
    $used_car_details_year = get_post_meta( $used_car_data->ID, 'used-car-details-year', true );
    ?>
    <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <label for="used-car-details-year"><?php echo esc_html_x( 'Year', 'used-car-single', 'mybooking-used-cars' ) ?></label>
        </th>
        <td style="width: 45%;">
          <input
            type="number"
            size="10"
            name="used-car-details-year"
            value="<?php echo esc_attr( $used_car_details_year ); ?>"
            id="used-car-details-year"
            class="components-text-control__input">
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Year of the vehicle.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
            </td>
        </td>
      </tr>
    </table>
                            
    <!-- Kms -->
    <?php
    $used_car_details_kms = get_post_meta( $used_car_data->ID, 'used-car-details-kms', true );
    ?>
    <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <label for="used-car-details-kms"><?php echo esc_html_x( 'Kms', 'used-car-single', 'mybooking-used-cars' ) ?></label>
        </th>
        <td style="width: 45%;">
          <input
            type="number"
            size="10"
            name="used-car-details-kms"
            value="<?php echo esc_attr( $used_car_details_kms ); ?>"
            id="used-car-details-kms"
            class="components-text-control__input">
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Kms of the vehicle.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
            </td>
        </td>
      </tr>
    </table>    

    <!-- Fuel type -->
    <?php
    $used_car_details_fuel = get_post_meta( $used_car_data->ID, 'used-car-details-fuel', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="used-car-details-fuel"><?php echo esc_html_x( 'Fuel type', 'used-car-single', 'mybooking-used-cars' ) ?></label>
          </th>
          <td style="width: 45%;">

            <select
                name="used-car-details-fuel"
                id="used-car-details-fuel"
                class="components-select-control__input"
                style="width: 100%">
                <option value=""><?php esc_html_e( 'Select fuel', 'mybooking-used-cars' ); ?></option>
                <option value="petrol"
                        <?php selected( $used_car_details_fuel, 'manual' ); ?>>
                        <?php echo esc_html_x( 'Petrol', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>
                <option value="diesel"
                        <?php selected( $used_car_details_fuel, 'automatic' ); ?>>
                        <?php echo esc_html_x( 'Diesel', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>
                <option value="electric"
                        <?php selected( $used_car_details_fuel, 'electric' ); ?>>
                        <?php echo esc_html_x( 'Electric', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>
                <option value="hybrid"
                        <?php selected( $used_car_details_fuel, 'hybrid' ); ?>>
                        <?php echo esc_html_x( 'Hybrid', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>                                   
            </select>
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Could be Diesel / Benzine or Electric.', 'used-car-single', 'mybooking-used-cars' ) ?></p>
          </td>
        </tr>
      </table>
    
    <!-- Engine --> 
    <?php
    $used_car_details_engine = get_post_meta( $used_car_data->ID, 'used-car-details-engine', true );
    ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="used-car-details-engine"><?php echo esc_html_x( 'Engine', 'used-car-single', 'mybooking-used-cars' ) ?></label>
            </th>
            <td style="width: 45%;">
              <input
                type="number"
                name="used-car-details-engine"
                value="<?php echo esc_attr( $used_car_details_engine ); ?>"
                id="used-car-details-engine"
                class="components-text-control__input">
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'CV', 'used-car-single', 'mybooking-used-cars' ) ?></p>
            </td>
          </tr>
        </tbody>
      </table>
    
    <!-- Gear -->  
    <?php
    $used_car_details_gear = get_post_meta( $used_car_data->ID, 'used-car-details-gear', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="used-car-details-gear"><?php echo esc_html_x( 'Transmission', 'used-car-single', 'mybooking-used-cars' ) ?></label>
          </th>
          <td style="width: 45%;">
            <select
                name="used-car-details-gear"
                id="used-car-details-gear"
                class="components-select-control__input"
                style="width: 100%">
                <option value=""><?php esc_html_e( 'Select a gear', 'mybooking-used-cars' ); ?></option>
                <option value="manual"
                        <?php selected( $used_car_details_gear, 'manual' ); ?>>
                        <?php echo esc_html_x( 'Manual', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>
                <option value="automatic"
                        <?php selected( $used_car_details_gear, 'automatic' ); ?>>
                        <?php echo esc_html_x( 'Automatic', 'used-car-single', 'mybooking-used-cars' ); ?>
                </option>                
            </select>
          </td>
          <td style="width: 45%;">
          <p class="description"><?php echo esc_html_x( 'Manual or automatic', 'used-car-single', 'mybooking-used-cars' ) ?></p>
          </td>
        </tr>
      </table>

    <?php

  }


  /* 
   * Save data
  */
  function save_used_car_metabox_data( $used_car_data_id ) {

    // Gallery
    if ( !empty($_POST['used-car-details-gallery']) ){

      // Build array for saving post meta
      $gallery_data = array();
      for ($i = 0; $i < count( $_POST['used-car-details-gallery']['image_url'] ); $i++ ){
        if ( '' != $_POST['used-car-details-gallery']['image_url'][$i]){
          $gallery_data['image_url'][] = $_POST['used-car-details-gallery']['image_url'][ $i ];
        }
      }
      if ( isset( $gallery_data ) ) {
        update_post_meta( $used_car_data_id, 'used-car-details-gallery-data', $gallery_data );
      }
      else {
        delete_post_meta( $used_car_data_id, 'used-car-details-gallery-data' );
      }
    }
    // Nothing received, all fields are empty, delete option
    else {
      delete_post_meta( $used_car_data_id, 'used-car-details-gallery-data' );
    }

    // Price
    if (  array_key_exists( 'used-car-details-price', $_POST )  ) {
      $used_car_price = sanitize_text_field( $_POST['used-car-details-price'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-price',
        $used_car_price
      );
    }

    // Brand
    if (  array_key_exists( 'used-car-details-brand', $_POST )  ) {
      $used_car_brand = intval( $_POST['used-car-details-brand'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-brand',
        $used_car_brand
      );
    }

    // Model
    if (  array_key_exists( 'used-car-details-model', $_POST )  ) {
      $used_car_model = intval( $_POST['used-car-details-model'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-model',
        $used_car_model
      );
    }

    // Year
    if (  array_key_exists( 'used-car-details-year', $_POST )  ) {
      $used_car_year = sanitize_text_field( $_POST['used-car-details-year'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-year',
        $used_car_year
      );
    }

    // Kms
    if (  array_key_exists( 'used-car-details-kms', $_POST )  ) {
      $used_car_year = sanitize_text_field( $_POST['used-car-details-kms'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-kms',
        $used_car_year
      );
    }

    // Fuel
    if (  array_key_exists( 'used-car-details-fuel', $_POST )  ) {
      $used_car_fuel = sanitize_text_field( $_POST['used-car-details-fuel'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-fuel',
        $used_car_fuel
      );
    }

    // Engine
    if (  array_key_exists( 'used-car-details-engine', $_POST )  ) {
      $used_car_engine = sanitize_text_field( $_POST['used-car-details-engine'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-engine',
        $used_car_engine
      );
    }

    // Gear
    if (  array_key_exists( 'used-car-details-gear', $_POST )  ) {
      $used_car_gear = sanitize_text_field( $_POST['used-car-details-gear'] );
      update_post_meta(
        $used_car_data_id,
        'used-car-details-gear',
        $used_car_gear
      );
    }

  }


  /* Move metabox below editor
   */
  function mybooking_move_used_car_metabox() {

    global $post, $wp_meta_boxes;

    do_meta_boxes(
      get_current_screen(),
      'advanced',
      $post
    );

    unset( $wp_meta_boxes['post']['advanced'] );
  }

  /* Used car Gallery scripts
   */
  function mybooking_used_car_gallery_styles_scripts() {
?>
<style type="text/css">
  // Gallery

.gallery_area {
    float:right;
}

.image_container {
    float:left!important;
    width: 120px;
    background: url('https://i.hizliresim.com/dOJ6qL.png');
    height: 120px;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 3px;
    cursor: pointer;
}

.image_container img{
    height: 120px;
    width: 120px;
    object-fit: cover;
    border-radius: 3px;
}

.clear {
  clear:both;
}

.gallery_wrapper {
    width: 100%;
    height: auto;
    position: relative;
    display: inline-block;
}

.gallery_wrapper input[type=text] {
    width:300px;
}

.gallery_wrapper .gallery_single_row {
    float: left;
    display:inline-block;
    width: 120px;
    position: relative;
    margin-right: 8px;
    margin-bottom: 20px;
}

.dolu {
    display: inline-block!important;
}

.gallery_wrapper label {
    padding:0 6px;
}

.button.remove {
    background: none;
    color: red;
    position: absolute;
    border: none;
    top: 4px;
    right: 7px;
    font-size: 1.2em;
    padding: 0px;
    box-shadow: none;
}

.button.remove:hover {
    background: none;
    color: #fff;
}

.button.add {
    background: #c3c2c2;
    color: #ffffff;
    border: none;
    box-shadow: none;
    width: 120px;
    height: 120px;
    line-height: 120px;
    font-size: 4em;
}

.button.add:hover, .button.add:focus {
    background: #e2e2e2;
    box-shadow: none;
    color: #0f88c1;
    border: none;
}
</style>
<script type="text/javascript">
    // Media uploader
    var media_uploader = null;

    /**
     * Remove single image
     */
    function remove_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

      jQuery(selectorImg).hide();
      jQuery(selectorAddButton).show();
      jQuery(selectorRemoveButton).hide();
      // Prepare the hidden field to hold the ID
      jQuery(selectorHidden).val('');

    }

    /**
     * Single image uploader
     */
    function open_media_uploader_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

      // Uploader
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){

        var length = media_uploader.state().get("selection").length;

        if (length == 1) {
          var image = media_uploader.state().get("selection").models[0];
          var image_id = image.attributes.id;
          var image_url = image.changed.url;
          jQuery(selectorImg).attr('src', image_url);
          jQuery(selectorImg).show();
          jQuery(selectorAddButton).hide();
          jQuery(selectorRemoveButton).show();
          // Prepare the hidden field to hold the ID
          jQuery(selectorHidden).val(image_id);
        }

      });
      media_uploader.open();

    }

    /**
     * Remove Image
     */
    function remove_img(value) {
      var parent=jQuery(value).parent().parent();
      parent.remove();
    }

    /**
     * Uploader image
     */
    function open_media_uploader_image(obj){
      // Upload image
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var image_id = json.id;
        var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
        jQuery(obj).append(html);
        // Prepare the hidden field to hold the ID
        jQuery(obj).find('.meta_image_url').val(image_id);
      });
      media_uploader.open();
    }

    /**
     * Uploader image
     */
    function open_media_uploader_image_this(obj){
      // Change image
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var image_id = json.id;
        jQuery(obj).attr('src',image_url);
        // Prepare the hidden field to hold the ID
        jQuery(obj).siblings('.meta_image_url').val(image_id);
      });
      media_uploader.open();
    }

    /**
     * Append image
     */
    function open_media_uploader_image_plus(){
      // Uploader
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: true
      });
      media_uploader.on("insert", function(){

        var length = media_uploader.state().get("selection").length;
        var images = media_uploader.state().get("selection").models;

        for(var i = 0; i < length; i++){
          var image_id = images[i].attributes.id;
          var image_url = images[i].changed.url;
          var box = jQuery('#master_box').html();
          jQuery(box).appendTo('#img_box_container');
          var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
          var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
          element.append(html);
          // Prepare the hidden field to hold the ID
          element.find('.meta_image_url').val(image_id);
        }
      });
      media_uploader.open();
    }
    jQuery(function() {
      jQuery("#img_box_container").sortable(); // Activate jQuery UI sortable feature
    });
    </script>
<?php
  }

  // Add metaboxes
  add_action( 'add_meta_boxes', 'add_used_car_metabox' );
  // Save posts
  add_action( 'save_post', 'save_used_car_metabox_data' );
  // Edit form after title
  add_action('edit_form_after_title', 'mybooking_move_used_car_metabox');
  // Add Scripts
  add_action( 'admin_head-post.php', 'mybooking_used_car_gallery_styles_scripts' );
  add_action( 'admin_head-post-new.php', 'mybooking_used_car_gallery_styles_scripts' );
