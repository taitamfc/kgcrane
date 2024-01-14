<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kgcrane' );

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
define( 'AUTH_KEY',         'YscOv8e5nbkMtfUpQGk00YYMLD4IMcBi3JOxSADmdeikgLboV5hWtXWxBB4Pjelx' );
define( 'SECURE_AUTH_KEY',  '4MPovORCwSp2JuSHufVQbtWyksDAjhQ5BzccN7B91VvI3grRTJsr0lZhnpVuEine' );
define( 'LOGGED_IN_KEY',    'xTUSFVsUn6B21BT817Ik7kys54nYJZLhwIfyRQ5sOgtvdI6S4q47GsYClOQpVLr5' );
define( 'NONCE_KEY',        'kKsP6Nvz3R0TkTLNB2lHOXdw9EVDafZwnbNzeVh9AKZKelsgBroj0APaUI9X6k17' );
define( 'AUTH_SALT',        'shINDvOg2RAoMAGjzqKXP0bon84b8dVXYw8MBoO1sATxaRvOsZCXPjhW3d5tMYa9' );
define( 'SECURE_AUTH_SALT', 'c2vRZM0fikV0drzIGwXpV1v9rO2caybXcxMhPEPjiM2UGq0N8tpqEkM8X7WIxek1' );
define( 'LOGGED_IN_SALT',   'vs7qlfzF5DaXLf2c13EG7nBfdOXiUYf2WYIDr7c7yASXn9L7GaEsMSQmzW7CtafI' );
define( 'NONCE_SALT',       'iU6GfHDQcv4t5YDiu67evyUmf7KQ0lkBgK5pZEIr3xwEvUkuuBBHocoiaWG6PwGa' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
