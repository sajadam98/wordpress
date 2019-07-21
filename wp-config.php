<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test' );

/** MySQL database username */
define( 'DB_USER', 'sajadam' );

/** MySQL database password */
define( 'DB_PASSWORD', '24206988431548' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'p*|n&8^}9?G5#Qoj7.e^+R`4UFZ9m5Vbj|~}C4} cdSyI6.;b>#6JV]<c[w1dpWL' );
define( 'SECURE_AUTH_KEY',  '*&TD7KEd[RgU!)=m;*P;7XV! ThBMK^.t*E)w*(f}gKKGYitx-:OC:X|D:%rI,b_' );
define( 'LOGGED_IN_KEY',    'wb~Kp<xSNaowzIiKVcndRqk7yahM71Jb1#Y[>@FRv-{`OWS?r%U%?&kj0TFWD?*u' );
define( 'NONCE_KEY',        'uUD{c{{2GznA]xqSUS3767p%@gK@s;kCxWN,*[e/YW>U*b9g 27Jgw}Js<v!lg0T' );
define( 'AUTH_SALT',        'Y _s$uk[(H*cov6SOiLo8[3fkVJF MOr%UR>9:Y?P)N5_vKi|OaBiaejb<o@0Zl9' );
define( 'SECURE_AUTH_SALT', '5]P)P w9Oj;tseaW;)}0#EoPV.g>P?t?} p)B$uOI?XHn*~JNHnS/?y}XPGiy=(_' );
define( 'LOGGED_IN_SALT',   'lHY&kB(zLCf|UL8^YA>N9^RW%vjR xLdv?S{D/~=l/8^DU0O#pt}B>g1i+(J+T#X' );
define( 'NONCE_SALT',       'L[av#&.`OG5P|,} =+9C;A o/~|4Ec{wH09YV0f#hKRyzVy%d_-cPI!!?B<LKaj;' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
