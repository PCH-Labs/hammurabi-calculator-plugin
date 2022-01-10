<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.webtus.net/techlab/ditizen
 * @since      1.0.0
 *
 * @package    Ignite_Core_Vitubroker
 * @subpackage Ignite_Core_Vitubroker/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

$react = new Hammurabi_Loan_Calculator_React();
$react->add_react_scripts(true);

?>

<script id="hammurabi-loan-calculator-react-app">
var hammurabiView = {
    page: 'screening',
};
</script>
<div id="hammurabi-tools"></div>