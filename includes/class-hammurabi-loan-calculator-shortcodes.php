<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.webtus.net/techlab/ditizen
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 * @author     Daniel Alvarez <daniel@webtus.net>
 */
class Hammurabi_Loan_Calculator_Shortcodes
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Adds Calculator react app trhough the use of a shortcode
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function insert_calculator($args)
	{
		ob_start();
		$shortcode_version = $args['version'];
		require_once(WP_PLUGIN_DIR . '/hammurabi-loan-calculator/public/partials/hammurabi-loan-calculator-public-display.php');
		return ob_get_clean();
	}

	/**
	 * Adds Calculator react app trhough the use of a shortcode
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function insert_screening($args)
	{
		ob_start();
		$shortcode_version = $args['version'];
		require_once(WP_PLUGIN_DIR . '/hammurabi-loan-calculator/public/partials/hammurabi-loan-screening-display.php');
		return ob_get_clean();
	}
}