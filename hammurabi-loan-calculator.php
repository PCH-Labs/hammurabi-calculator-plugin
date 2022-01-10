<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pchlabs.com/plugins
 * @since             1.0.0
 * @package           Hammurabi_Loan_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       Hammurabi Tools
 * Plugin URI:        https://pchlabs.com/plugins/loan-calculator
 * Description:       Set of tools developed by PCHLABS, in order to connect this site to SimplyBorrowed's Loan Managemente System: Hammurabi
 * Version:           1.0.0
 * Author:            PCHLABS
 * Author URI:        https://pchlabs.com/plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hammurabi-loan-calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('HAMMURABI_LOAN_CALCULATOR_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hammurabi-loan-calculator-activator.php
 */
function activate_Hammurabi_Loan_Calculator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-hammurabi-loan-calculator-activator.php';
	Hammurabi_Loan_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hammurabi-loan-calculator-deactivator.php
 */
function deactivate_Hammurabi_Loan_Calculator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-hammurabi-loan-calculator-deactivator.php';
	Hammurabi_Loan_Calculator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_Hammurabi_Loan_Calculator');
register_deactivation_hook(__FILE__, 'deactivate_Hammurabi_Loan_Calculator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-hammurabi-loan-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Hammurabi_Loan_Calculator()
{

	$plugin = new Hammurabi_Loan_Calculator();
	$plugin->run();
}
run_Hammurabi_Loan_Calculator();