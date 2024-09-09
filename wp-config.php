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
define( 'DB_NAME', 'acekinet_ace' );

/** Database username */
define( 'DB_USER', 'acekinet_ace' );

/** Database password */
define( 'DB_PASSWORD', 'a#BG}m8AI_&l' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'f4kschhwhwvhuptfzic7ui42bpfs3n5npw1vseolgctrqql6xepvnwrnza0uudar' );
define( 'SECURE_AUTH_KEY',  '91wlbxmpd3omwrrrplgagjylsfbwzt3tsgsurikfbtmcesbqaohints6en9ibksd' );
define( 'LOGGED_IN_KEY',    'vwkfq78xb8onangxmkvjjgf1uqmfioahtdkqrnicrdo45mrnsnv0sgmceuytdqab' );
define( 'NONCE_KEY',        'ubarprkkvzbetlrlwumueh2axundttmkbytsvwqu4me0hvbdv6qgswvskcjijvey' );
define( 'AUTH_SALT',        'rg5bjx3xv6eckbmvco0obsuzyrwglan729fvvld39hmutllw2on4gqw4gknwyjsp' );
define( 'SECURE_AUTH_SALT', 'y4vgyrf7waz2ylyoois0uhly1l0tg3uuouqpofqyzam2gvhtjlp93lqdcebfsjwb' );
define( 'LOGGED_IN_SALT',   'hl0lhvrviyk6lqsfuf1sqxy2gaoqx1egeeo3yylpowhza2he4v1ep4czxy766gvr' );
define( 'NONCE_SALT',       'znya94r07idzz0faew9bed01iy52pfqtp36ijwsrpyliobpcnr4i4nzvpzqsxxa4' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp7b_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
