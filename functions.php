// Redirect to another page if the user isn't logged in. Good for membership websites.
add_action( 'template_redirect', function() {

    if( ( !is_page('2') ) ) {

        if (!is_user_logged_in() ) {
            wp_redirect( site_url() );        // redirect all...
            exit();
        }

    }

});

// show admin bar only for admins
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}

// Redirect users to homepage if someone accesses the login page. You can change it to another page as well.
add_action('init','possibly_redirect');
function possibly_redirect(){
 global $pagenow;
 if( 'wp-login.php' == $pagenow ) {
  wp_redirect('/');
  exit();
 }
}

// Updating jQuery
function replace_core_jquery_version() {
    wp_deregister_script( 'jquery' );
    // Change the URL if you want to load a local copy of jQuery from your own server.
    wp_register_script( 'jquery', "https://code.jquery.com/jquery-3.1.1.min.js", array(), '3.1.1' );
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );

// Hide Admin Notices
function pr_disable_admin_notices() {
        global $wp_filter;
            if ( is_user_admin() ) {
                if ( isset( $wp_filter['user_admin_notices'] ) ) {
                                unset( $wp_filter['user_admin_notices'] );
                }
            } elseif ( isset( $wp_filter['admin_notices'] ) ) {
                        unset( $wp_filter['admin_notices'] );
            }
            if ( isset( $wp_filter['all_admin_notices'] ) ) {
                        unset( $wp_filter['all_admin_notices'] );
            }
    }
add_action( 'admin_print_scripts', 'pr_disable_admin_notices' );
