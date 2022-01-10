<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pchlabs.com/plugins
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/admin
 * @author     PCHLABS
 */
class Hammurabi_Loan_Calculator_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hammurabi_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hammurabi_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/hammurabi-loan-calculator-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hammurabi_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hammurabi_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/hammurabi-loan-calculator-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Admin area menu.
	 * 
	 * Adds the Admin area menu options and checks if Ignite Core is not 
	 * installed in order to add it first as a container to other admin
	 * options
	 *
	 * @since    1.0.0
	 */
	public function admin_menu()
	{
		// This role should change for a custom data role
		$capability = 'activate_plugins';
		add_menu_page("Loan Calculator", "Hammurabi", $capability, 'hammurabi-loan-calculator-admin', array($this, 'main_menu'), '', '68');
		add_submenu_page('hammurabi-loan-calculator-admin', "Loan Calculator - Hammurabi", 'Ignite Connect', $capability, 'hammurabi-loan-calculator-admin', array($this, 'main_menu'));
	}

	/**
	 * Ignite Core main Menu
	 * 
	 * This functions calls the core class in order to include the 
	 * iframe with the Ignite Core Woocommerce Connect panel in orden
	 * to talk to users about the service network.
	 *
	 * @since    1.0.0
	 */
	public function main_menu()
	{
		return "<h1>Loan Calculator</h1>";
	}
}