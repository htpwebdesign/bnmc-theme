<?php

require_once get_template_directory() . '/inc/cpt-taxonomies.php';

function bnmc_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __( 'Service Details', 'bnmc-theme' ),
        'bnmc_render_service_meta_box',
        'bnmc-service',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'bnmc_add_service_meta_boxes' );

function bnmc_render_service_meta_box( $post ) {
    wp_nonce_field( 'bnmc_service_meta_nonce', 'bnmc_service_nonce' );
    $price = get_post_meta( $post->ID, '_service_price', true );
    $duration = get_post_meta( $post->ID, '_service_duration', true );
    ?>
    <p>
        <label for="service_price"><?php _e( 'Price:', 'bnmc-theme' ); ?></label>
        <input type="text" name="service_price" id="service_price" value="<?php echo esc_attr( $price ); ?>" />
    </p>
    <p>
        <label for="service_duration"><?php _e( 'Duration:', 'bnmc-theme' ); ?></label>
        <input type="text" name="service_duration" id="service_duration" value="<?php echo esc_attr( $duration ); ?>" />
    </p>
    <?php
}

function bnmc_save_service_meta( $post_id ) {
    if ( ! isset( $_POST['bnmc_service_nonce'] ) || 
         ! wp_verify_nonce( $_POST['bnmc_service_nonce'], 'bnmc_service_meta_nonce' ) ) {
        return;
    }
    
    if ( isset( $_POST['service_price'] ) ) {
        update_post_meta( $post_id, '_service_price', sanitize_text_field( $_POST['service_price'] ) );
    }
    
    if ( isset( $_POST['service_duration'] ) ) {
        update_post_meta( $post_id, '_service_duration', sanitize_text_field( $_POST['service_duration'] ) );
    }
}
add_action( 'save_post_bnmc-service', 'bnmc_save_service_meta' );

function bnmc_add_service_meta_to_rest() {
    register_rest_field( 'bnmc-service',
        'service_details',
        array(
            'get_callback' => 'bnmc_get_service_meta_for_api',
            'schema' => null,
        )
    );
}

function bnmc_get_service_meta_for_api( $object ) {
    $post_id = $object['id'];
    return array(
        'price' => get_post_meta( $post_id, '_service_price', true ),
        'duration' => get_post_meta( $post_id, '_service_duration', true )
    );
}
add_action( 'rest_api_init', 'bnmc_add_service_meta_to_rest' );

function add_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poiret+One&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// add image sizes
// Crop images to 400px by 500px
add_image_size( '400x500', 400, 500, true );

// Crop images to 200px by 250px
add_image_size( '200x250', 200, 250, true );

// Make custom sizes selectable from WordPress admin.
function mindset_add_custom_image_sizes( $size_names ) {
	$new_sizes = array(
		'400x500' => __( '400x500', 'bnmc-theme' ),
		'200x250' => __( '200x250', 'bnmc-theme' ),
	);
	return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'bnmc_add_custom_image_sizes' );
