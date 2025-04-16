<?php

// Register Custom Post Type for 'Services'
function bnmc_register_service_post_type() {
    $labels = array(
        'name'               => __( 'Services', 'bnmc-theme' ),
        'singular_name'      => __( 'Service', 'bnmc-theme' ),
        'add_new'            => __( 'Add New Service', 'bnmc-theme' ),
        'add_new_item'       => __( 'Add New Service', 'bnmc-theme' ),
        'edit_item'          => __( 'Edit Service', 'bnmc-theme' ),
        'new_item'           => __( 'New Service', 'bnmc-theme' ),
        'view_item'          => __( 'View Service', 'bnmc-theme' ),
        'search_items'       => __( 'Search Services', 'bnmc-theme' ),
        'not_found'          => __( 'No services found', 'bnmc-theme' ),
        'not_found_in_trash' => __( 'No services found in Trash', 'bnmc-theme' ),
    );

    $args = array(
        'label'               => __( 'Services', 'bnmc-theme' ),
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-admin-tools',
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'bnmc-service', $args );
}
add_action( 'init', 'bnmc_register_service_post_type' );

// Include additional CPT and taxonomy definitions if needed
require_once get_template_directory() . '/inc/cpt-taxonomies.php';

// Add Meta Box for Service Details
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

// Save Meta Box Fields
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

// Add Meta to REST API
function bnmc_add_service_meta_to_rest() {
    register_rest_field( 'bnmc-service',
        'service_details',
        array(
            'get_callback' => 'bnmc_get_service_meta_for_api',
            'schema'       => null,
        )
    );
}

function bnmc_get_service_meta_for_api( $object ) {
    $post_id = $object['id'];
    return array(
        'price'    => get_post_meta( $post_id, '_service_price', true ),
        'duration' => get_post_meta( $post_id, '_service_duration', true )
    );
}
add_action( 'rest_api_init', 'bnmc_add_service_meta_to_rest' );

// Enqueue Google Fonts
function add_google_fonts() {
    wp_enqueue_style( 
        'google-fonts', 
        'https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poiret+One&display=swap', 
        false 
    );
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// Add custom image sizes
add_image_size( '400x500', 400, 500, true );
add_image_size( '200x250', 200, 250, true );

// Make custom image sizes selectable in the admin
function mindset_add_custom_image_sizes( $size_names ) {
    $new_sizes = array(
        '400x500' => __( '400x500', 'bnmc-theme' ),
        '200x250' => __( '200x250', 'bnmc-theme' ),
    );
    return array_merge( $size_names, $new_sizes );
}
add_filter( 'image_size_names_choose', 'mindset_add_custom_image_sizes' );
