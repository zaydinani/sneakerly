<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sneakerly' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Kxxs8QQYgQ5bS38bl5Og8fDYKxpm577Sr3njPTb4u7Kf9rMId1vQrz0BJ7OAlYOz' );
define( 'SECURE_AUTH_KEY',  'zGve0FL7hhrAkxKxYnhahN4vEUL5t5EDurCkWQqZav8LemZoGHKkEsEaGCTDe9o8' );
define( 'LOGGED_IN_KEY',    '4kvY6tk8PucEfEfUUfMuUBvNIStZohV3D8bcFE5b5hLQKiFfQz7cmaGQvREQtJO5' );
define( 'NONCE_KEY',        'ixktXE5tT7vlPdF2pdhJqqkVBMMgDAsLeNKVEGQWIfK6lr7LrYF90xM34AAF1Rrj' );
define( 'AUTH_SALT',        'VHfOCAVlABwaEoUCl6qpIIcjuksvil1aNiLQo1V0ovZbWL4Iiy1MSf0txuXXLGH6' );
define( 'SECURE_AUTH_SALT', 'psdF49zWD1PnemUTccbtlHhUQXE0OOhPuwTeaEPVymxB235UZV6hx9wdIhDsrB9G' );
define( 'LOGGED_IN_SALT',   'FcYqG1h2oCH9sVOY9boxytVq5eWYyCaKjJYtOKLyhLc9XFxfAvppv7EK8PozWS92' );
define( 'NONCE_SALT',       'YCpj7bGwgyl5eVbiXZIm5ZLEDMNWcPo8XUuJfJ6p1STNIOLQ4M2viNaY1fofOATC' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
