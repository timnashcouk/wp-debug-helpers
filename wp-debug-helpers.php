<?php

/**
 * Plugin Name:       WP Debug Helpers
 * Description:       Add helpful Debug with Code pinched from Ross Wintle/Peter Hegman
 * Version:           1.0.0
 * Requires PHP:      7.2.5
 * Author:            Tim Nash based on work by Peter Hegman & Ross Wintle
 * Author URI:        https://timnash.co.uk/
 * License:           MIT
 * License URI:       https://mit-license.org/
 * Text Domain:       wp-debug-helpers
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Autoload Composer packages
require __DIR__ . '/vendor/autoload.php';

// If we haven't loaded this plugin from Composer we need to add our own autoloader
if (!class_exists('PeterHegman\Dumper')) {
    // Get a reference to our PSR-4 Autoloader function that we can use to add our
    $autoloader = require_once('autoload.php');

    // Use the autoload function to setup our class mapping
			$autoloader('PeterHegman\\', __DIR__ . '/src/PeterHegman/');
}

/**
* Disable Wordpress emoji's as they mess with the var-dumper
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            (new PeterHegman\Dumper)->dump($x);
        }, func_get_args());

        die(1);
    }
}

if (!function_exists('dump')) {
    /**
     * Dump the passed variables
     *
     * @param  mixed
     * @return void
     */
    function dump()
    {
			echo
        array_map(function ($x) {
            (new PeterHegman\Dumper)->dump($x);
        }, func_get_args());
    }
}

if (!function_exists('dc')) {
	/**
	 * Dump the passed variables to Console
	 *
	 * @param  mixed
	 * @return void
	 */
	function dc($x, $s=true)
	{
		$o = 'console.log('.json_encode($x, JSON_HEX_TAG).');';
		if($s) {
			$o = '<script>'.$o.'</script>';
		}
		echo $o;
	}
}

if (!function_exists('backtrace')) {
	/**
	 * Print out the current backtrace
	 *
	 * @param  mixed
	 * @return void
	 */
	function backtrace()
	{
		ob_start();
		debug_print_backtrace();
		$t = ob_get_contents();
		ob_end_clean();
		//Remove the first method, because its this one!
		$t = preg_replace ('/^#0\s+' . __FUNCTION__ . "[^\n]*\n/", '', $t, 1);
		//very hacky should have its own formatter
		(new PeterHegman\Dumper)->dump($t);
	}
}
