<?php

function bnmc_register_custom_post_types() {
    // --- Services CPT ---
    $service_labels = array(
        'name'                     => _x( 'Services', 'post type general name', 'bnmc-theme' ),
        'singular_name'            => _x( 'Service', 'post type singular name', 'bnmc-theme' ),
        'add_new'                  => _x( 'Add New', 'service', 'bnmc-theme' ),
        'add_new_item'             => __( 'Add New Service', 'bnmc-theme' ),
        'edit_item'                => __( 'Edit Service', 'bnmc-theme' ),
        'new_item'                 => __( 'New Service', 'bnmc-theme' ),
        'view_item'                => __( 'View Service', 'bnmc-theme' ),
        'view_items'               => __( 'View Services', 'bnmc-theme' ),
        'search_items'             => __( 'Search Services', 'bnmc-theme' ),
        'not_found'                => __( 'No services found.', 'bnmc-theme' ),
        'not_found_in_trash'       => __( 'No services found in Trash.', 'bnmc-theme' ),
        'parent_item_colon'        => __( 'Parent Services:', 'bnmc-theme' ),
        'all_items'                => __( 'All Services', 'bnmc-theme' ),
        'archives'                 => __( 'Service Archives', 'bnmc-theme' ),
        'attributes'               => __( 'Service Attributes', 'bnmc-theme' ),
        'insert_into_item'         => __( 'Insert into service', 'bnmc-theme' ),
        'uploaded_to_this_item'    => __( 'Uploaded to this service', 'bnmc-theme' ),
        'featured_image'           => __( 'Service featured image', 'bnmc-theme' ),
        'set_featured_image'       => __( 'Set service featured image', 'bnmc-theme' ),
        'remove_featured_image'    => __( 'Remove service featured image', 'bnmc-theme' ),
        'use_featured_image'       => __( 'Use as featured image', 'bnmc-theme' ),
        'menu_name'                => _x( 'Services', 'admin menu', 'bnmc-theme' ),
        'filter_items_list'        => __( 'Filter services list', 'bnmc-theme' ),
        'items_list_navigation'    => __( 'Services list navigation', 'bnmc-theme' ),
        'items_list'               => __( 'Services list', 'bnmc-theme' ),
        'item_published'           => __( 'Service published.', 'bnmc-theme' ),
        'item_published_privately' => __( 'Service published privately.', 'bnmc-theme' ),
        'item_reverted_to_draft'   => __( 'Service reverted to draft.', 'bnmc-theme' ),
        'item_trashed'             => __( 'Service trashed.', 'bnmc-theme' ),
        'item_scheduled'           => __( 'Service scheduled.', 'bnmc-theme' ),
        'item_updated'             => __( 'Service updated.', 'bnmc-theme' ),
        'item_link'                => __( 'Service link.', 'bnmc-theme' ),
        'item_link_description'    => __( 'A link to a service.', 'bnmc-theme' ),
    );

    $service_args = array(
        'labels'              => $service_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'services' ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-yes-alt',
        'supports'            => array( 'title', 'editor' ),
    );
    register_post_type( 'bnmc-service', $service_args );

    // --- Radiologists CPT ---
    $radiologist_labels = array(
        'name'                     => _x( 'Radiologists', 'post type general name', 'bnmc-theme' ),
        'singular_name'            => _x( 'Radiologist', 'post type singular name', 'bnmc-theme' ),
        'add_new'                  => _x( 'Add New', 'radiologist', 'bnmc-theme' ),
        'add_new_item'             => __( 'Add New Radiologist', 'bnmc-theme' ),
        'edit_item'                => __( 'Edit Radiologist', 'bnmc-theme' ),
        'new_item'                 => __( 'New Radiologist', 'bnmc-theme' ),
        'view_item'                => __( 'View Radiologist', 'bnmc-theme' ),
        'view_items'               => __( 'View Radiologists', 'bnmc-theme' ),
        'search_items'             => __( 'Search Radiologists', 'bnmc-theme' ),
        'not_found'                => __( 'No radiologists found.', 'bnmc-theme' ),
        'not_found_in_trash'       => __( 'No radiologists found in Trash.', 'bnmc-theme' ),
        'parent_item_colon'        => __( 'Parent Radiologists:', 'bnmc-theme' ),
        'all_items'                => __( 'All Radiologists', 'bnmc-theme' ),
        'archives'                 => __( 'Radiologist Archives', 'bnmc-theme' ),
        'attributes'               => __( 'Radiologist Attributes', 'bnmc-theme' ),
        'insert_into_item'         => __( 'Insert into radiologist', 'bnmc-theme' ),
        'uploaded_to_this_item'    => __( 'Uploaded to this radiologist', 'bnmc-theme' ),
        'featured_image'           => __( 'Radiologist featured image', 'bnmc-theme' ),
        'set_featured_image'       => __( 'Set radiologist featured image', 'bnmc-theme' ),
        'remove_featured_image'    => __( 'Remove radiologist featured image', 'bnmc-theme' ),
        'use_featured_image'       => __( 'Use as featured image', 'bnmc-theme' ),
        'menu_name'                => _x( 'Radiologists', 'admin menu', 'bnmc-theme' ),
        'filter_items_list'        => __( 'Filter radiologists list', 'bnmc-theme' ),
        'items_list_navigation'    => __( 'Radiologists list navigation', 'bnmc-theme' ),
        'items_list'               => __( 'Radiologists list', 'bnmc-theme' ),
        'item_published'           => __( 'Radiologist published.', 'bnmc-theme' ),
        'item_published_privately' => __( 'Radiologist published privately.', 'bnmc-theme' ),
        'item_reverted_to_draft'   => __( 'Radiologist reverted to draft.', 'bnmc-theme' ),
        'item_trashed'             => __( 'Radiologist trashed.', 'bnmc-theme' ),
        'item_scheduled'           => __( 'Radiologist scheduled.', 'bnmc-theme' ),
        'item_updated'             => __( 'Radiologist updated.', 'bnmc-theme' ),
        'item_link'                => __( 'Radiologist link.', 'bnmc-theme' ),
        'item_link_description'    => __( 'A link to a radiologist.', 'bnmc-theme' ),
    );

    $radiologist_args = array(
        'labels'              => $radiologist_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'radiologists' ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-businessperson',
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
    );
    register_post_type( 'bnmc-radiologist', $radiologist_args );
}
add_action( 'init', 'bnmc_register_custom_post_types' );

function bnmc_register_taxonomies() {
    // --- Services Taxonomy ---
    $service_tax_labels = array(
        'name'                  => _x( 'Service Categories', 'taxonomy general name', 'bnmc-theme' ),
        'singular_name'         => _x( 'Service Category', 'taxonomy singular name', 'bnmc-theme' ),
        'search_items'          => __( 'Search Service Categories', 'bnmc-theme' ),
        'all_items'             => __( 'All Service Categories', 'bnmc-theme' ),
        'parent_item'           => __( 'Parent Service Category', 'bnmc-theme' ),
        'parent_item_colon'     => __( 'Parent Service Category:', 'bnmc-theme' ),
        'edit_item'             => __( 'Edit Service Category', 'bnmc-theme' ),
        'view_item'             => __( 'View Service Category', 'bnmc-theme' ),
        'update_item'           => __( 'Update Service Category', 'bnmc-theme' ),
        'add_new_item'          => __( 'Add New Service Category', 'bnmc-theme' ),
        'new_item_name'         => __( 'New Service Category Name', 'bnmc-theme' ),
        'menu_name'             => __( 'Service Categories', 'bnmc-theme' ),
        'items_list_navigation' => __( 'Service Categories list navigation', 'bnmc-theme' ),
        'items_list'            => __( 'Service Categories list', 'bnmc-theme' ),
        'item_link'             => __( 'Service Category Link', 'bnmc-theme' ),
        'item_link_description' => __( 'A link to a service category.', 'bnmc-theme' ),
    );

    $service_tax_args = array(
        'hierarchical'      => true,
        'labels'            => $service_tax_labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'service-category' ),
    );
    register_taxonomy( 'bnmc-service-category', array( 'bnmc-service' ), $service_tax_args );

    // --- Specialisation Taxonomy ---
    $specialisation_labels = array(
        'name'                  => _x( 'Specialisations', 'taxonomy general name', 'bnmc-theme' ),
        'singular_name'         => _x( 'Specialisation', 'taxonomy singular name', 'bnmc-theme' ),
        'search_items'          => __( 'Search Specialisations', 'bnmc-theme' ),
        'all_items'             => __( 'All Specialisations', 'bnmc-theme' ),
        'parent_item'           => __( 'Parent Specialisation', 'bnmc-theme' ),
        'parent_item_colon'     => __( 'Parent Specialisation:', 'bnmc-theme' ),
        'edit_item'             => __( 'Edit Specialisation', 'bnmc-theme' ),
        'view_item'             => __( 'View Specialisation', 'bnmc-theme' ),
        'update_item'           => __( 'Update Specialisation', 'bnmc-theme' ),
        'add_new_item'          => __( 'Add New Specialisation', 'bnmc-theme' ),
        'new_item_name'         => __( 'New Specialisation Name', 'bnmc-theme' ),
        'menu_name'             => __( 'Specialisations', 'bnmc-theme' ),
        'items_list_navigation' => __( 'Specialisations list navigation', 'bnmc-theme' ),
        'items_list'            => __( 'Specialisations list', 'bnmc-theme' ),
        'item_link'             => __( 'Specialisation Link', 'bnmc-theme' ),
        'item_link_description' => __( 'A link to a specialisation.', 'bnmc-theme' ),
    );

    $specialisation_args = array(
        'hierarchical'      => true,
        'labels'            => $specialisation_labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'specialisation' ),
    );
    register_taxonomy( 'bnmc-specialisation', array( 'bnmc-radiologist' ), $specialisation_args );
}
add_action( 'init', 'bnmc_register_taxonomies' );
