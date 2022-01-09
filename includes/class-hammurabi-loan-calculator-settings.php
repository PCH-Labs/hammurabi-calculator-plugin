<?php

/**
 * The file that the plugin's settings
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.webtus.net/techlab/ditizen
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 */

/**
 * The plugin's Settings Class
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
 * @author     Daniel Alvarez <daniel@webtus.net>
 */
class Hammurabi_Loan_Calculator_Settings
{
	/**
	 * Option key to save settings
	 *
	 * @var string
	 */
	protected $option_key = '_hammurabi_loan_calculator_settings';

	/**
	 * Option key to save settings
	 *
	 * @var string
	 */
	protected $option_group = 'hammurabiLoanCalculator';
	/**
	 * Default settings
	 *
	 * @var array
	 */
	protected $defaults = array(
		'activated'			=> true
	);
	/**
	 * Get saved settings
	 *
	 * @since 		1.0.0
	 * @param 		string	Settings options
	 * @return		array   Settings object
	 */
	public function get_settings(string $group = 'all')
	{

		$saved = get_option($this->option_key, array());
		if (!is_array($saved) || empty($saved)) {
			return $this->defaults;
		}
		return $saved;
	}

	/**
	 * Save settings
	 *
	 * Array keys must be whitelisted (IE must be keys of self::$defaults
	 *
	 * @since 		1.0.0
	 * @param 		array $settings
	 */
	public function save_settings(array $settings,  string $group = 'all')
	{

		//remove any non-allowed indexes before save
		foreach ($settings as $i => $setting) {
			if (!array_key_exists($i, $this->defaults)) {
				unset($settings[$i]);
			}
		}
		update_option($this->option_key, $settings);
	}

	/**
	 * Register settings with default options
	 *
	 * @since 		1.0.0
	 */

	public function register_settings()
	{
		register_setting($this->option_group, $this->option_key, array('default' => $this->defaults));
	}
}