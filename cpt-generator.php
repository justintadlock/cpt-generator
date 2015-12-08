<?php
/**
 * Plugin Name: CPT Generator
 * Plugin URI:  http://themehybrid.com/plugins
 * Description: Playing with cool stuff.
 * Version:     1.0.0-dev
 * Author:      Justin Tadlock
 * Author URI:  http://themehybrid.com
 * Text Domain: cpt-generator
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not,
 * write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package   CPTGenerator
 * @version   1.0.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2015, Justin Tadlock
 * @link      http://themehybrid.com/plugins
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Singleton class for setting up the plugin.
 *
 * @since  1.0.0
 * @access public
 */
final class CPT_Generator_Plugin {

	/**
	 * Plugin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';

	/**
	 * Plugin directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';

	/**
	 * Plugin CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';

	/**
	 * Plugin JS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';

	/**
	 * Page slug in the admin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $tools_page = '';

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up globals.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function setup() {

		// Main plugin directory path and URI.
		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );

		// Plugin directory URIs.
		$this->css_uri = trailingslashit( $this->dir_uri . 'css' );
		$this->js_uri  = trailingslashit( $this->dir_uri . 'js'  );
	}

	/**
	 * Sets up main plugin actions and filters.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );

		// Add admin pages.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		// Enqueue scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Adds admin page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_menu() {

		$this->tools_page = add_submenu_page(
			'tools.php',
			esc_html__( 'CPT Generator', 'members' ),
			esc_html__( 'CPT Generator', 'members' ),
			'manage_options',
			'cpt-generator',
			array( $this, 'tools_page' )
		);
	}

	/**
	 * Loads scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $hook
	 * @return void
	 */
	public function enqueue_scripts( $hook ) {

		if ( $this->tools_page === $hook ) {

			$min = '';

			wp_enqueue_script( 'cpt-generator', $this->js_uri . "cpt-generator{$min}.js", array( 'wp-util' ), '', true );

			// Localize our script with some text we want to pass in.
			$labels = array(
				'post_type_singular' => esc_html__( 'Post Type:', 'cpt-generator' ),
				'post_type_plural'   => esc_html__( 'Plural:', 'cpt-generator' )
			);

			$data = array(
				'labels'             => $labels,
				'post_type_singular' => 'example',
				'post_type_plural'   => 'examples',
			);

			wp_localize_script( 'cpt-generator', 'cptg_data', $data );

			// Load Underscrore templates.
			add_action( 'admin_footer', array( $this, 'load_templates' ) );
		}
	}

	/**
	 * Loads Underscore.js templates.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function load_templates() { ?>

		<script type="text/html" id="tmpl-cptg-form">
			<?php require_once( $this->dir_path . 'tmpl/form.php' ); ?>
		</script>
	<?php }

	/**
	 * Outputs the tools sub-menu page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function tools_page() { ?>

		<div class="wrap">

			<h1><?php _e( 'Custom Post Type Generator', 'cpt-generator' ); ?></h1>

			<div class="cptg-form-wrap"></div>

		</div><!-- .wrap -->

	<?php }

	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'cpt-generator', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
	}
}

// Let's roll!
CPT_Generator_Plugin::get_instance();
