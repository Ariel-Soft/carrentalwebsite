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
define('DB_NAME', 'carrent_wp');

/** MySQL database username */
define('DB_USER', 'carrent_rental');

/** MySQL database password */
define('DB_PASSWORD', 'Spring2013!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '$m}O`3,V `o@^3iAq;No7F4 DZBaSW9n9*D.x(nxCE%i8C=-OVuS/+Q73dI+hk_|');
define('SECURE_AUTH_KEY',  '#3d2cIVT7iX[`?i|Fc--UN,il2DS73xN[fW.6OmK`1UQvp|RrWAA_!-@WR[4J[S*');
define('LOGGED_IN_KEY',    'PNU5xIli >oU`dmGnO67y-m:b$P|~f< t&YO-`kuYhv$j$*ZzM27d P0[C</Nt+X');
define('NONCE_KEY',        '3r~y++DJ|dgJqGFn1QOBDmPwCm}@kL]r+t)ppJ1g`^%.WOfdawUxfi6Vg+PcEdxv');
define('AUTH_SALT',        'zug:!]xd|_@i>X*vB}Iq^{M]rP=&pb3xsj])EvXf{!rK/f+3A{|e;PobLYpD(eT_');
define('SECURE_AUTH_SALT', ')|9eE(Q+p}BAZi}<w@w]dAS.2-7r:(Iwk(,Z]V{8oOp[c!a(n=jY}.ml%wnS3u$!');
define('LOGGED_IN_SALT',   'h6^+J][@sj++y>oS@*wdPBT8A0FhbXkl;?gQXQNQimA4}RzLX1,Hmo5~edQgwgDl');
define('NONCE_SALT',       '!]Ad[`xf/lBeK8L?j|$C+y!hzD):g/No~3.9weO|a]NLg.~_,-PGejF5?[L]+2|M');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
