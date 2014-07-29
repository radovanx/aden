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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/immoneda/www/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'immonedasql');

/** MySQL database username */
define('DB_USER', 'immonedasql');

/** MySQL database password */
define('DB_PASSWORD', 'iloveaden965');

/** MySQL hostname */
define('DB_HOST', 'mysql51-133.bdb');

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
define('AUTH_KEY',         'b+kE`G7,+d(;%[.{3o4g~:Q*&-XLo]=z@/BVk2m|*5HJ]_YC!-j;b:k1naA2U>4B');
define('SECURE_AUTH_KEY',  'RDgyX+1WJJ0h4cCKI*$ aC+HQ|*8eyR^h#~gT:s{!&wIs|pK%-=;3I$*RyyEeEx<');
define('LOGGED_IN_KEY',    'uK@#2LKslq*ERlnvE,&1FpJvt6+XrrZd?V&fPXG2;}-tJ`xBRepWo(mth8CF4V<R');
define('NONCE_KEY',        'bgBkObnw{ZE|I,P1w6HCqGn}d+<Cu?4tK[<n2hf*7r#6G<q#NsW*]RbslQ#]iMOL');
define('AUTH_SALT',        'Y%0(/f{+nVMFO3yO1=:dg:7IU>+ 0&@y[2v`kI|G KU^ 4l]B{{wXAA<1t4Bd=*;');
define('SECURE_AUTH_SALT', 'pJuR16PkJyB<wKoO|s4MX,*D69+Vwv87lH:R&[eLCLJdt><5j.CM@,[[By5{IZ`D');
define('LOGGED_IN_SALT',   'dzB*[:(8h${WuzjVSNM`5*@J@}JX+GDYhX|r1%3hz!Sia4!MZ^{fgle<];XE([80');
define('NONCE_SALT',       '=x-`0p2f_XL{L-qI-04zmSo%+7).hAkmD:9{iaa)4U?cQ$)GDK]jb|NA0Z-d5I!>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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


// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');