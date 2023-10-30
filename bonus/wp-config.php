<?php
define( 'WP_HOME', 'http://192.168.1.111:8081' );
define( 'WP_SITEURL', 'http://192.168.1.111:8081' );
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

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'wp' );


/** Database username */

define( 'DB_USER', 'h4h4' );


/** Database password */

define( 'DB_PASSWORD', '34syp4ss' );


/** Database hostname */

define( 'DB_HOST', 'MySQL:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'XmAl<j_1mq4yQ$~)<-iDPh&:s>bE._jv|^WmrL8,qT-VV/4M6L)J4_!xF^y|}tmF' );

define( 'SECURE_AUTH_KEY',  '/ySR&hGFv.07e<m?];aD@Aq/LHMCz_Su90T%ahX)z^T[vZsRx}RMcfS$rXvGdW|u' );

define( 'LOGGED_IN_KEY',    '86ORVqG!+(bd34X;*d^%Sn#P#GWVd17_FH5;(Y^N;i7ASj,R,VY+.rUj4w7Cz5V' );

define( 'NONCE_KEY',        'jLe_Fg7V=g*b.oRIK?BP?~`B7Goh{RyeUUF]MO/1Rj&$xxnie}>GPNA@[WI~<Y=X' );

define( 'AUTH_SALT',        'J+>mo,G9<Jg^UZz*~>[x8,Vkow3I1lgBfIH=!q1Cn_Q~$&b:#8^%3(L gESmwwhv' );

define( 'SECURE_AUTH_SALT', 'hx{g!;3HJ5m|UniA3~`@i`nM{;ktoX(_&a)?VC.]HKEzhwU.w)J5zbSbf1C +S[Z' );

define( 'LOGGED_IN_SALT',   'a[fPD!yv+3P9ND_:|Uz*]gAW&+jLmwsGXT9zUR=GL3[!Pl<RN*hS_<2)iC>36Ig;' );

define( 'NONCE_SALT',       'Q&;4Wnjo :_z{(cj(.|P(WC,F~CeT!Cy/Kz.kkKdpFDgD16IH,B<@y_((TqT!0)0' );


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

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
