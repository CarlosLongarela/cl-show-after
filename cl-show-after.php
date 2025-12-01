<?php
/**
 * Plugin Name: CL Show After
 * Description: Shortcode to show enclosed content only after a specific date and time.
 * Version: 1.0.2
 * Author: Carlos Longarela
 * Author URI: https://tabernawp.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cl-show-after
 * Domain Path: /languages
 * Requires at least: 6.5
 * Requires PHP: 8.1
 *
 * @package CL Show After
 * @author  Carlos Longarela
 * @license GPL-2.0+
 * @link    https://tabernawp.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Shortcode to display content after a specific date and time.
 *
 * Usage: [cl_show_after date-time="2025-12-01 12:00"]Content[/cl_show_after]
 *
 * @param array  $atts    Shortcode attributes.
 * @param string $content Shortcode content.
 * @return string Content if the date has passed, empty string otherwise.
 */
function cl_show_after_shortcode( $atts, $content = null ) {
	// Extract attributes.
	$atts = shortcode_atts(
		array(
			'date-time' => '',
		),
		$atts,
		'cl_show_after'
	);

	// Return empty if no date-time is provided.
	if ( empty( $atts['date-time'] ) ) {
		return '';
	}

	try {
		// Get WP timezone using modern WP function.
		$timezone = wp_timezone();

		// Validate and create DateTime object for target time.
		$target_dt = DateTime::createFromFormat( 'Y-m-d H:i', $atts['date-time'], $timezone );

		// Check if the format matches strictly.
		if ( ! $target_dt || $target_dt->format( 'Y-m-d H:i' ) !== $atts['date-time'] ) {
			return '';
		}

		// Get current time using modern WP function.
		$current_dt = current_datetime();

		// Compare timestamps.
		if ( $current_dt >= $target_dt ) {
			// Process nested shortcodes and return content.
			return do_shortcode( $content );
		}
	} catch ( Exception $e ) {
		// Fail silently if date format is invalid.
		return '';
	}

	return '';
}
add_shortcode( 'cl_show_after', 'cl_show_after_shortcode' );
