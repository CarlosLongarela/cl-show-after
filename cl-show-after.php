<?php
/**
 * Plugin Name: CL Show After
 * Description: Shortcode to show enclosed content only after a specific date and time.
 * Version: 1.0.0
 * Author: Carlos Longarela
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

	// Get WP timezone.
	$timezone_string = get_option( 'timezone_string' );

	// If timezone_string is empty, it means manual offset is used (e.g., UTC+1).
	if ( ! $timezone_string ) {
		$gmt_offset     = get_option( 'gmt_offset' );
		$offset_hours   = (int) $gmt_offset;
		$offset_minutes = ( $gmt_offset - $offset_hours ) * 60;
		$offset_string  = sprintf( '%+03d:%02d', $offset_hours, abs( $offset_minutes ) );
		try {
			$timezone = new DateTimeZone( $offset_string );
		} catch ( Exception $e ) {
			$timezone = new DateTimeZone( 'UTC' );
		}
	} else {
		$timezone = new DateTimeZone( $timezone_string );
	}

	try {
		// Create DateTime objects for target and current time in the site's timezone.
		$target_dt  = new DateTime( $atts['date-time'], $timezone );
		$current_dt = new DateTime( 'now', $timezone );

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
