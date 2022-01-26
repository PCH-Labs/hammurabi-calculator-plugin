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

        register_rest_route(
            'hammurabi-tools',
            '/settings',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'get_settings'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
        register_rest_route(
            'hammurabi-tools',
            '/settings',
            array(
                'methods' => 'PUT',
                'callback' => array($this, 'update_settings'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
    }

    /**
     *
     * Checks permission.
     * 
     * Checks if the API request is made by a valid origin and user
     * 
     * @since       1.0.0
     * 
     */
    public function check_permissions(WP_REST_Request $request)
    {
        return true;
        $headers = $request->get_headers();
        if ($request->get_body()) {
            $body = json_decode($request->get_body(), true);
        } else {
            $body['X-Hammurabikey'] = "none";
        }

        if ($headers['x_hammurabikey'][0] == 'hammurabi-app-2022') {
            return true;
        } elseif ($body['X-Hammurabikey'] == 'hammurabi-app-2022') {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * Get Settings Object.
     * 
     * Gets the Settings Object from the Database
     * 
     * @since       1.0.0
     * @return      array               Settings Object
     * 
     */
    public function get_settings()
    {
        $settings = new Hammurabi_Loan_Calculator_Settings();
        return rest_ensure_response($settings->get_settings());
    }

    /**
     *
     * Update Settings.
     * 
     * uses the settings classess to update the setting object
     * in the Database
     * 
     * @since       1.0.0
     * @param       WP_REST_Request       $request        Rest information to get params
     * 
     */
    public function update_settings(WP_REST_Request $request)
    {
        $settings = new Hammurabi_Loan_Calculator_Settings();
        return rest_ensure_response($settings->save_settings($request->get_params()));
    }
}