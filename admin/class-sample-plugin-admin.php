<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       saqibnaeem.com
 * @since      1.0.0
 *
 * @package    Sample_Plugin
 * @subpackage Sample_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sample_Plugin
 * @subpackage Sample_Plugin/admin
 * @author     NXB <saqib.naeem@nxb.com.pk>
 */
class Sample_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public $books;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();
		
	}

	private function load_dependencies(){
		require_once plugin_dir_path( dirname(__FILE__) ). "admin/class-books-posttype.php";
		require_once plugin_dir_path( dirname(__FILE__) )."admin/class-books-metaboxes.php";
		require_once plugin_dir_path( dirname(__FILE__) )."admin/class-sample-plugin-menu.php";
		require_once plugin_dir_path( dirname(__FILE__) )."admin/widgets/class-sample-site-logo.php";
		require_once plugin_dir_path( dirname(__FILE__) )."admin/partials/class-sample-custom-new-ticker.php";
		
	}

	public function register_books_posttype(){
		$books_class = new Books_Posttype();
		$books_class->create_posttype();
	}
	public function register_books_metaboxes(){
		$books_class = new Books_Metaboxes();
		$books_class->create_metabox();
	}
	public function save_books_metaboxes(){
		$books_class = new Books_Metaboxes();
		$books_class->save();
	}
	public function register_menu(){
		$menu_class = new Sample_Plugin_Menu();
		$menu_class->add_main_menu();
	}
	public function site_logo_widget(){
		// $widget_class = new Sample_Site_Logo_Widget();
		register_widget( "Sample_Site_Logo_Widget" );
	}
	public function news_ticker(){
		$news_ticker_class = new Sample_Custom_News_Ticker();
		$news_ticker_class->menu_item();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */

	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sample_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sample_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sample-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sample_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sample_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sample-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}



}
