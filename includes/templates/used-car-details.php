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