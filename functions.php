<?php
/**
 * Theme Functions
 * Organized and reviewed for clarity, efficiency, and best practices.
 */

/*--------------------------------------------------------------
# Theme Setup
--------------------------------------------------------------*/
function bnmc_theme_setup() {
    add_theme_support( 'editor-styles' );
    add_editor_style( get_stylesheet_uri() );

    // Add custom image sizes
    add_image_size('400x500', 400, 500, true);
    add_image_size('200x250', 200, 250, true);
}
add_action( 'after_setup_theme', 'bnmc_theme_setup' );

// Make custom sizes selectable from WordPress admin.
function bnmc_add_custom_image_sizes($size_names) {
    $new_sizes = array(
        '400x500' => __('400x500', 'bnmc-theme'),
        '200x250' => __('200x250', 'bnmc-theme'),
    );
    return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'bnmc_add_custom_image_sizes');

/*--------------------------------------------------------------
# Enqueue Styles and Scripts
--------------------------------------------------------------*/
// Normalize.css
function enqueue_normalize_css() {
    wp_enqueue_style(
        'normalize',
        get_template_directory_uri() . '/styles/normalize.css',
        array(),
        null,
        'all'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_normalize_css');

// Theme stylesheet
function enqueue_theme_styles() {
    wp_enqueue_style('bnmc-theme', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// Front page only styles
function my_theme_enqueue_front_page_styles() {
    if (is_front_page()) {
        wp_enqueue_style(
            'front-page-style',
            get_template_directory_uri() . '/styles/front-page.css',
            array(),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_front_page_styles');

// Stats tabs JS
function enqueue_stats_tabs_assets() {
    wp_enqueue_script(
        'stats-tabs-js',
        get_template_directory_uri() . '/assets/js/tabs.js',
        [],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_stats_tabs_assets');

/*--------------------------------------------------------------
# Analytics
--------------------------------------------------------------*/
// Add PostHog Analytics to wp_head
function add_posthog_analytics() {
    ?>
    <script>
      !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.crossOrigin="anonymous",p.async=!0,p.src=s.api_host.replace(".i.posthog.com","-assets.i.posthog.com")+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="init capture register register_once register_for_session unregister unregister_for_session getFeatureFlag getFeatureFlagPayload isFeatureEnabled reloadFeatureFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSurveysLoaded onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey canRenderSurveyAsync identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException loadToolbar get_property getSessionProperty createPersonProfile opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing clear_opt_in_out_capturing debug getPageViewId captureTraceFeedback captureTraceMetric".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);posthog.init('phc_76cE63movdaC1x8T2A63BBp4GyZN128sOYVdJbREToA',{api_host:'https://us.i.posthog.com',person_profiles:'identified_only'})
    </script>
    <?php
}
add_action('wp_head', 'add_posthog_analytics');

/*--------------------------------------------------------------
# Custom Post Types and Taxonomies
--------------------------------------------------------------*/
require_once get_template_directory() . '/inc/cpt-taxonomies.php';

/*--------------------------------------------------------------
# Service Meta Box (for CPT "bnmc-service")
--------------------------------------------------------------*/
// Add Meta Box
function bnmc_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Service Details', 'bnmc-theme'),
        'bnmc_render_service_meta_box',
        'bnmc-service',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'bnmc_add_service_meta_boxes');

// Render Meta Box
function bnmc_render_service_meta_box($post) {
    wp_nonce_field('bnmc_service_meta_nonce', 'bnmc_service_nonce');
    $price = get_post_meta($post->ID, '_service_price', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    ?>
    <p>
        <label for="service_price"><?php _e('Price:', 'bnmc-theme'); ?></label>
        <input type="text" name="service_price" id="service_price" value="<?php echo esc_attr($price); ?>" />
    </p>
    <p>
        <label for="service_duration"><?php _e('Duration:', 'bnmc-theme'); ?></label>
        <input type="text" name="service_duration" id="service_duration" value="<?php echo esc_attr($duration); ?>" />
    </p>
    <?php
}

// Save Meta Box Fields
function bnmc_save_service_meta($post_id) {
    if (
        ! isset($_POST['bnmc_service_nonce']) ||
        ! wp_verify_nonce($_POST['bnmc_service_nonce'], 'bnmc_service_meta_nonce')
    ) {
        return;
    }
    if (isset($_POST['service_price'])) {
        update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
    }
    if (isset($_POST['service_duration'])) {
        update_post_meta($post_id, '_service_duration', sanitize_text_field($_POST['service_duration']));
    }
}
add_action('save_post_bnmc-service', 'bnmc_save_service_meta');

/*--------------------------------------------------------------
# REST API: Add Service Meta
--------------------------------------------------------------*/
function bnmc_add_service_meta_to_rest() {
    register_rest_field(
        'bnmc-service',
        'service_details',
        array(
            'get_callback' => 'bnmc_get_service_meta_for_api',
            'schema'       => null,
        )
    );
}
add_action('rest_api_init', 'bnmc_add_service_meta_to_rest');

function bnmc_get_service_meta_for_api($object) {
    $post_id = $object['id'];
    return array(
        'price'    => get_post_meta($post_id, '_service_price', true),
        'duration' => get_post_meta($post_id, '_service_duration', true)
    );
}


// Remove <a> tags from bnmc-specialisation taxonomy terms and wrap in <span>
function bnmc_strip_term_links( $links ) {
  foreach ( $links as &$html ) {
      $name  = strip_tags( $html );
      $html  = '<span class="bnmc-term-badge">' . esc_html( $name ) . '</span>';
  }
  return $links;
}
add_filter( 'term_links-bnmc-specialisation', 'bnmc_strip_term_links' );

// Swap <a>→<span> in Core Post Terms block for bnmc-specialisation taxonomy
function bnmc_unanchor_post_terms_block( $block_content, $block ) {
  if (
      ! empty( $block['attrs']['taxonomy'] ) &&
      $block['attrs']['taxonomy'] === 'bnmc-specialisation'
  ) {
      $block_content = preg_replace(
          '#<a[^>]*>(.*?)</a>#i',
          '<span class="bnmc-term-badge">$1</span>',
          $block_content
      );
  }
  return $block_content;
}
add_filter( 'render_block_core/post-terms', 'bnmc_unanchor_post_terms_block', 10, 2 );

// Remove author name and URL from oEmbed response data
add_filter( 'oembed_response_data', function( $data, $post, $context ) {
  unset( $data['author_name'], $data['author_url'] );
  return $data;
}, 99, 3 );


function add_walkthrough_dashboard_widget() {
    wp_add_dashboard_widget(
        'walkthrough_widget', // Widget ID
        'Site Walkthrough Guide', // Widget Title
        'walkthrough_widget_content' // Callback function name
    );
}
add_action('wp_dashboard_setup', 'add_walkthrough_dashboard_widget');

function walkthrough_widget_content() {
    echo '<p><a href="' . esc_url( site_url('/wp-content/uploads/walkthrough.pdf') ) . '" target="_blank">📄 View Site Walkthrough (PDF)</a></p>';
}


// Add custom login logo
function my_login_logo() { ?>
  <style type="text/css">
    
      body.login {
          background-color:rgb(161, 188, 224); 
      } 

      #login h1 a {
          background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/site-login-logo.png');
          background-size: contain;
          background-repeat: no-repeat;
          width: 250px;   
          height: 250px;   
          display: block;
          margin: 0 auto 30px auto;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// Change the login logo URL to the home page
function my_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
  return 'BNMC MRI Clinic';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );