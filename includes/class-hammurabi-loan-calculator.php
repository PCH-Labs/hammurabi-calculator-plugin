<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://pchlabs.com/plugins
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 * @author     PCHLABS
 */
class Hammurabi_Loan_Calculator
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Hammurabi_Loan_Calculator_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('HAMMURABI_LOAN_CALCULATOR_VERSION')) {
			$this->version = HAMMURABI_LOAN_CALCULATOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'hammurabi-loan-calculator';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcodes();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Hammurabi_Loan_Calculator_Loader. Orchestrates the hooks of the plugin.
	 * - Hammurabi_Loan_Calculator_i18n. Defines internationalization functionality.
	 * - Hammurabi_Loan_Calculator_Admin. Defines all hooks for the admin area.
	 * - Hammurabi_Loan_Calculator_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-hammurabi-loan-calculator-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-hammurabi-loan-calculator-public.php';
		/**
		 * The class responsible for defining all actions that occur in the shortcode
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-settings.php';
		/**
		 * The class responsible for defining all actions that occur in the shortcode
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-api.php';
		/**
		 * The class responsible for defining all actions that occur in the shortcode
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-react.php';
		/**
		 * The class responsible for defining all actions that occur in the shortcode
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hammurabi-loan-calculator-shortcodes.php';

		$this->loader = new Hammurabi_Loan_Calculator_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Hammurabi_Loan_Calculator_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Hammurabi_Loan_Calculator_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Hammurabi_Loan_Calculator_Admin($this->get_plugin_name(), $this->get_version());
		$plugin_api = new Hammurabi_Loan_Calculator_API();

		$this->loader->add_action('admin_menu', $plugin_admin, 'admin_menu');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_settings = new Hammurabi_Loan_Calculator_Settings();
		$plugin_public = new Hammurabi_Loan_Calculator_Public($this->get_plugin_name(), $this->get_version(), $plugin_settings->get_settings());

		$this->loader->add_action('init', $plugin_settings, 'register_settings');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Register all of the shortcodes related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_shortcodes()
	{

		$plugin_shortcodes = new Hammurabi_Loan_Calculator_Shortcodes($this->get_plugin_name(), $this->get_version());
		$this->loader->add_shortcode('hammurabi_calculator', $plugin_shortcodes, 'insert_calculator');
		$this->loader->add_shortcode('hammurabi_screening', $plugin_shortcodes, 'insert_screening');
	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Hammurabi_Loan_Calculator_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}