<?php

class Options
{
	private $post_type = 'special';

	public function __construct()
    {
        add_action('admin_menu', array( $this, 'register_cs_option_page') );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_plugin_css' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_plugin_js' ) );
//        add_action( 'init', array( $this, 'add_image_sizes' ));
    }
    public function register_cs_option_page() {
        add_submenu_page( 'options-general.php', 'Options for CS Page', 'CS Options', 'manage_options', 'cs_option_menu_page', array( $this, 'show_cs_option_menu_page' ) );
    }
    public function show_cs_option_menu_page() {
        ob_start();
        require_once( dirname( __FILE__ ) . '/admin/template.php' );
        $output = ob_get_clean();
        echo $output;
    }

    public function load_plugin_css()
    {

        $plugin_url = plugin_dir_url( __FILE__ );
        wp_enqueue_style( 'cs_style', $plugin_url . 'css/style.css' );

	    if ( get_post_type( $post_id ) == $this->post_type ) {

		    if (is_post_type_archive($this->post_type) ) {
			    wp_enqueue_style( 'bs_4_css', $plugin_url . 'css/bootstrap.min.css' );
		    } else {
			    wp_enqueue_style( 'bs_4_css', $plugin_url . 'css/bootstrap.min.css' );
		    }

	    }

//        wp_enqueue_style( 'bs_4', $plugin_url . 'css/bootstrap.min.css' );
    }
    public function load_plugin_js()
    {
	    wp_enqueue_script('cs_js', plugins_url('/js/cs_script.js', __FILE__), array('jquery'), NULL, true);

	    if ( get_post_type( $post_id ) == $this->post_type ) {

		    if (is_post_type_archive($this->post_type) ) {
//			    wp_enqueue_script('jquery_bs_4', plugins_url('/js/jquery-3.2.1.slim.min.js', __FILE__), NULL, NULL, true);
			    wp_enqueue_script('bs_4_js', plugins_url('/js/bootstrap.min.js', __FILE__), array('jquery'), NULL, true);
		    } else {
//			    wp_enqueue_script('jquery_bs_4', plugins_url('/js/jquery-3.2.1.slim.min.js', __FILE__), NULL, NULL, true);
			    wp_enqueue_script('bs_4_js', plugins_url('/js/bootstrap.min.js', __FILE__), array('jquery'), NULL, true);
		    }

	    }
    }

}