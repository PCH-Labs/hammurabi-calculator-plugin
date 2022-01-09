<?php

/**
 * Use to add and control placement of react scripts
 *
 * @link       https://webtus.net/techblab
 * @since      1.0.0
 *
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 */


/**
 * Use to add and control placement of react scripts.
 *  
 * This class gets the information from the Assets-manifest.json
 * to load all the scripts and css files needed for running 
 * the React App
 *
 * @since      1.0.0
 * @package    Hammurabi_Loan_Calculator
 * @subpackage Hammurabi_Loan_Calculator/includes
 * @author     Daniel Alvarez <daniel@webtus.net>
 */
class Hammurabi_Loan_Calculator_React
{

    /**
     * Adds React Scripts.
     *
     * Checks the manifest adds the js and css files as well as 
     * localize the script to send variables to the app
     *
     * @since       1.0.0
     * @param       boolean     $bypass     Check if is on admin page
     * @param       string      $page       Page name
     * 
     */
    public function add_react_scripts($bypass = false, $page = '')
    {

        if (isset($_GET['page']) && $_GET['page'] != 'hammurabi-loan-calculator' && !$bypass)
            return;

        if (isset($_GET['page']) && $page !== '') {
            $page = $_GET['page'];
        }

        // Setting path variables.
        $react_app_build = WP_PLUGIN_URL . '/hammurabi-loan-calculator/build/';
        $manifest_url = $react_app_build . 'asset-manifest.json';

        // Request manifest file.
        $request = file_get_contents(dirname(dirname(__FILE__)) . '/build/asset-manifest.json');

        // If the remote request fails, wp_remote_get() will return a WP_Error, so let’s check if the $request variable is an error:
        if (!$request)
            return false;

        // Convert json to php array.
        $files_data = json_decode($request);
        if ($files_data === null)
            return;

        if (!property_exists($files_data, 'entrypoints'))
            return false;

        // Get assets links.
        $assets_files = $files_data->entrypoints;

        $js_files = array_filter($assets_files, array($this, 'rp_filter_js_files'));
        $css_files = array_filter($assets_files, array($this, 'rp_filter_css_files'));

        // Load css files.
        foreach ($css_files as $index => $css_file) {
            wp_enqueue_style('react-plugin-' . $index, $react_app_build . $css_file);
        }

        // Load js files.
        foreach ($js_files as $index => $js_file) {
            wp_enqueue_script('react-plugin-' . $index, $react_app_build . $js_file, array(), 1, true);
        }
        // Variables for app use.
        wp_localize_script(
            'react-plugin-0',
            'rpReactPlugin',
            array(
                'appSelector' => '#hammurabi-loan-calculator',
                'nonce' => wp_create_nonce('wp_rest'),
                'url' => get_rest_url(null, '/'),
                'page' => $page,
                'assetsUrl' =>  plugin_dir_url((dirname(__FILE__))) . 'build/',
                'pluginVersion' => Hammurabi_Loan_Calculator_VERSION,
                'siteLanguage' => str_split(get_locale(), 2)[0]
            )
        );
    }

    /**
     * Get js files from assets array.
     *
     * @since       1.0.0
     * @param       array       $file_string
     * @return      bool
     */
    public function rp_filter_js_files($file_string)
    {
        return pathinfo($file_string, PATHINFO_EXTENSION) === 'js';
    }

    /**
     * Get css files from assets array.
     *
     * @since       1.0.0
     * @param       array       $file_string     
     * @return      bool
     */
    public function rp_filter_css_files($file_string)
    {
        return pathinfo($file_string, PATHINFO_EXTENSION) === 'css';
    }
}
