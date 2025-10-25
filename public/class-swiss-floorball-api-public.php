<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://flaviowaser.ch
 * @since      1.0.0
 *
 * @package    Swiss_Floorball_Api
 * @subpackage Swiss_Floorball_Api/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Swiss_Floorball_Api
 * @subpackage Swiss_Floorball_Api/public
 * @author     Flavio Waser <kontakt@flawas.ch>
 */
class Swiss_Floorball_Api_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->register_shortcodes();
		$this->load_dependencies();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Swiss_Floorball_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Swiss_Floorball_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/swiss-floorball-api-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Swiss_Floorball_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Swiss_Floorball_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/swiss-floorball-api-public.js', array( 'jquery' ), $this->version, false );

	}

	public function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions.php';
	}

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'get-club-teams', array( $this, 'get_club_teams_func' ) );
		add_shortcode( 'get-club-games', array( $this, 'get_club_games_func' ) );
		add_shortcode( 'get-team-games', array( $this, 'get_team_games_func' ) );

	} // register_shortcodes()

	public function get_club_teams_func() {
		ob_start();
		get_club_teams_pub(get_option('swissfloorball_club_number'));
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public function get_club_games_func(){
		ob_start();
		get_club_games(get_option('swissfloorball_club_number'), get_option('swissfloorball_actual_season'));
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public function get_team_games_func( $atts ){
		$a = shortcode_atts( array(
			'team_id' => '',
		), $atts );

		ob_start();
		get_team_games($a['team_id'], get_option('swissfloorball_actual_season'));
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}
