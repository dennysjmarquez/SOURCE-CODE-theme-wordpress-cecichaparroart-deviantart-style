<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Customization.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *+
 * @package Modules\Customization
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();
$thb_tc = $thb_theme->getCustomization();

$app_counter = 0;





// -----------------------------------------------------------------------------
// Footer
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_footer', __('Footer', 'thb_text_domain') );

// Footer sidebar --------------------------------------------------------------

	$thb_tc->addColorSetting(array(
		'#footer' => 'background-color'

	), '#333', __('Footer background', 'thb_text_domain'));

// Overlay ---------------------------------------------------------------------

if( !function_exists('thb_overlay') ) {
	function thb_overlay( $value=null, $selector=null ) {
		$overlay_css = '';
		$overlay_css .= '.thb-overlay {';
			$overlay_css .= 'background: ' . $value . ';' ;
			$overlay_css .= 'background: rgba(' . implode(',', thb_color_hexToRgb($value)) . ', .6);' ;
		$overlay_css .= '}';

		return $overlay_css;
	}
}

// -----------------------------------------------------------------------------

add_action( 'customize_register', array($thb_tc, 'register') );