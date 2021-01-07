## WP Debug Helpers
Contributors: tnash, magicroundabout, phegman\
Tags: debug, die, dump, var-dumper, laravel, dev tools\
Requires at least: 5.5.0\
Tested up to: 5.5.0\
License: MIT\
License URI: https://mit-license.org/\
\
Basic Debugging options\
\
### Description
Multiple functions just to make debugging easier:

[`dd()`] - Use Laravel's [`dd()`](https://laravel.com/docs/5.4/helpers#method-dd) (die dump) function in your Wordpress projects. Perfect for debuging custom queries! Laravel's `dd()` function is built on top of the [Symfony VarDumper component](http://symfony.com/doc/current/components/var_dumper.html)
**Please note in order for this plugin to work correctly Wordpress Emojis will be disabled**

[`dc()`] - Print out response to the Browser Console rather then directly to the screen

[`backtrace()`] - Print out the current backtrace/stacktrace without requiring an exception error to be thrown.

### Ray support
If using [Ray](https://myray.app/) by Spatie, you can drop in a ray.php at any location with the following default configuration:
```
<?php
return array(
		/*
		 *  The host used to communicate with the Ray app.
		 */
		'host' => 'localhost',

		/*
		 *  The port number used to communicate with the Ray app.
		 */
		'port' => 23517,
);
```

### Installation

1.  Install via Github and place in /wp-content/plugins directory
2.  Activate the plugin through the \'Plugins\' menu in WordPress
