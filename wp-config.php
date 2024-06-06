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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'order_invoice' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'i<zJXV<<)922>X.A>Wm>.Hj<1aA HizaSyS!Zd?|KpyIdTS`n[vs!rO*tRFNk#iJ' );
define( 'SECURE_AUTH_KEY',  'ci-MmO>kU.kL&4(.DoryM6jj@k*[K$eT{0[#^Xlo%eth:/Bj0{*]|h>fGLVoj**4' );
define( 'LOGGED_IN_KEY',    'c@uLThD@b=J*iJ8~WA2-@XDP*0Q-eQ[m3~Cr%0U%6`gX1yX,Bu+1~C%e$S #45jD' );
define( 'NONCE_KEY',        'zW>n9>?@;LN1F]_3-UWC~;k?[S6f%#JVi[4!B@z6 l,I%W8!T_>:dQN{yk_N1)yK' );
define( 'AUTH_SALT',        '+xl5 $GZ=hnI]<ZvO6OoIVSUY0koumwH[Ut$$=v rZW_jQa}>x9w ![)cDQ*fe9^' );
define( 'SECURE_AUTH_SALT', 'V0{vs+Yc_/- *X8:7e1P~n4JG?0(H_isT(9n)uej;GQ>T{5%pcp-I?`cj+)e[zYm' );
define( 'LOGGED_IN_SALT',   '_@b&SzAACy%r2.Y|~z^p6~o:_YDd;=4P4E^8yHBc0iEO7IAV%Rn$Vb^nu9L5aTT2' );
define( 'NONCE_SALT',       'm5ng>CmUq+r^HO?>e>g,4 ]8:GYk$YG`gO0UQ,Bzm.mGHVrf Z/E8A- ioO]8v67' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */

if ( defined( 'XMLRPC_REQUEST' ) || defined( 'REST_REQUEST' ) || ( defined( 'WP_INSTALLING' ) && WP_INSTALLING )  ) {
	@ini_set( 'display_errors', 1 );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\k2');

