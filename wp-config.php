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
define( 'DB_NAME', 'pdo_model' );

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
define( 'AUTH_KEY',         '-N+TGOWT*UBJXn+wt` yi$K.`o|_G{?Q`)hcdQ$9a^Cq7Ng4Sy@c|e>n-#0OFmRN' );
define( 'SECURE_AUTH_KEY',  '+cHS8])(z{ed&51(kZdZmAs(s$`~XS@LlJvwHn5wN>2`KQRyub}Q!5yG/Bb_c6u;' );
define( 'LOGGED_IN_KEY',    'E@@=,DY`Pw!g=NDYAGeEJH7Cv4B#TX3#K1yP]WKb:qZ%2vmC0,i|UC2XDObOP5A1' );
define( 'NONCE_KEY',        'TQ~5(*(=UZ8*x32KU]QP$X@Vh@;y+u$6KAu/=52qbU/`NBFJV%%uo1tury*4y1Rt' );
define( 'AUTH_SALT',        'J75DEvQjYJz,lWq/sWL @)~lP6]hxT19FcLV]@Kp(>S[Z8&%D[(xUj?N[%IN 2Rn' );
define( 'SECURE_AUTH_SALT', 'ev<CeWiMDLnxB,;fh=Wkx,;=|f#)eyIMsx9s$}WWOh5=up-!V,&%Bfp 5YlQsn>t' );
define( 'LOGGED_IN_SALT',   '-!*Y%l9#16Z0v-Di0E$1JIZis>3+dw%+DBO^+kIp~?TD dhU,:HmkKL6%Sh^ay=s' );
define( 'NONCE_SALT',       'mK?u_t9L=9kx^wO)E^ ~W{yZ#(C4{F4`!^gl~o%X*){TG7%k&#u%[>[jh/xdeSfU' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
