<?php

/**
 * The API Endpoints for REST Communication
 *
 * A class that registers and checks all te RESTful endpoints
 * communication to use with the react application
 * 
 * @link       https://www.webtus.net/techlab/ditizen
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 */

/**
 * The API Endpoints for REST Communication
 *
 * A class that registers and checks all te RESTful endpoints
 * communication to use with the react application
 *
 * @since      1.0.0
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 * @author     Ditizen <daniel@webtus.net>
 */
class Hammurabi_Loan_Calculator_API
{

    private $settings;

    public function __construct()
    {
        $config = new Hammurabi_Loan_Calculator_Settings();
        $this->settings = $config->get_settings();
    }

    /**
     *
     * Adds Api Routes.
     * 
     * Register all the routes needed for RESTfull communication
     * 
     * @since       1.0.0
     * 
     */
    public function add_api_routes()
    {
        // register_rest_route(
        //     'hammurabi-loan-calculator',
        //     '/settings',
        //     array(
        //         'methods' => 'POST',
        //         'callback' => array($this, 'get_settings'),
        //         'permission_callback' => array($this, 'check_permissions')
        //     )
        // );

    }

    public function check_permissions()
    {
        return true;
    }
}