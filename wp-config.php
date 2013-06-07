<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
define( 'DB_NAME', 'restaur2_aryatvseries' );

/** MySQL database username */
define( 'DB_USER', 'restaur2_solotv' );

/** MySQL database password */
define( 'DB_PASSWORD', 'qwerty2736' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't7#Kp5, |0`QF7Q_ h(?R3o{6&z#30xH6Ua:+F,}7^Ej#JDU0XVmk>>m77mo-|tm');
define('SECURE_AUTH_KEY',  'g3H!*lX=ir~GmM]X@QpAj*k-(TRI&d%hZL#!Xo?/KM|]LLIXM`m-<%_b2Dnh`)N4');
define('LOGGED_IN_KEY',    '+-BqF0;j*#V6{8=nA|fA#S:b^/atIf:J4+K`$&QH@Fc||[c+Ri&b_.EsqUG=|I}-');
define('NONCE_KEY',        ':=_|a-F`7%HY<(f+3I^Lgglq/kT,>RWAgOc>]axL|^U,Bqr,O._<pa-99ohE@lR!');
define('AUTH_SALT',        'yDp(P<z`_Zm0Mn.WgxrKz6 ~,/6Y}8y!DLmxT~o+[a42/+]X@q9* rEUZ=V M8k7');
define('SECURE_AUTH_SALT', 'HJ] OubpAM_DUK.hGP;+W-F+OI%ZsZoaXf3T*742UhDgmemi]{lN08k),T7FdDvv');
define('LOGGED_IN_SALT',   'etDz-(DdJcH7riQ{o6V^SK3vhp,65:4)HQ!=o)Ys tRQfrUVib;X9(7WCg+7t+PW');
define('NONCE_SALT',       ' 3c2l_=xU~NxfJ<pY+|^-p;bK&Pg%= qm}~Rl.R+B_u?8/CtvKoH&vZWD[,?:6N)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');?>