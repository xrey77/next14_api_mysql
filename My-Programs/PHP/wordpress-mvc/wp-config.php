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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'de35dffmqifr7j' );

/** MySQL database username */
define( 'DB_USER', 'crgtcpjqgnpysw' );

/** MySQL database password */
define( 'DB_PASSWORD', '3f55f6cfa65a5433f822a22de88eb1dd2a7d2baa5579d53ccaa0cd696d385aa8' );

/** MySQL hostname */
define( 'DB_HOST', 'ec2-18-234-17-166.compute-1.amazonaws.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );



// SMTP email settings
// define( 'SMTP_username', 'rey107@gmail.com' );  // username of host like Gmail
// define( 'SMTP_password', 'Reynald@88.88' );   // password for login into the App
// define( 'SMTP_server', 'smtp.gmail.com' );     // SMTP server address
// define( 'SMTP_FROM', 'reynald88@yahoo.com' );   // Your Business Email Address
// define( 'SMTP_NAME', 'Wincor-Nixdorf Team' );   //  Business From Name
// define( 'SMTP_PORT', '587' );     // Server Port Number
// define( 'SMTP_SECURE', 'tls' );   // Encryption - ssl or tls
// define( 'SMTP_AUTH', true );  // Use SMTP authentication (true|false)
// define( 'SMTP_DEBUG',   0 );  // for debugging purposes only

define( 'SMTP_USER',   'rey107@gmail.com' );    // Username to use for SMTP authentication
define( 'SMTP_PASS',   'Reynald@88.88' );       // Password to use for SMTP authentication
define( 'SMTP_HOST',   'smtp.gmail.com' );    // The hostname of the mail server
define( 'SMTP_FROM',   'reynald88@hotmail.com' ); // SMTP From email address
define( 'SMTP_NAME',   'Wincor-Nixdorf Team' );    // SMTP From name
define( 'SMTP_PORT',   '25' );                  // SMTP port number - likely to be 25, 465 or 587
define( 'SMTP_SECURE', 'tls' );                 // Encryption system to use - ssl or tls
define( 'SMTP_AUTH',    true );                 // Use SMTP authentication (true|false)
define( 'SMTP_DEBUG',   0 );  











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
define( 'AUTH_KEY',         'kK1Z4+IDE3qeSK=s_R?d52Bi&ReQq1fx3G-tiM8o-JkV&a%EPOz$vh2.#euX0NWy' );
define( 'SECURE_AUTH_KEY',  'oRpL|oObW+/K*J9=;<0l8>UYqK<%D!DZqFBis`Y(Iq7UL@Rq3Iqfz]vg[~)U=E~G' );
define( 'LOGGED_IN_KEY',    ';x.t/O5O}C]pnAH<nlt#$xg#IC1~E/q?}gI,yusGdE9to`,tj-HbhD$$MLx28902' );
define( 'NONCE_KEY',        '9b=e6jXQ&utN)!4A|Tx~*Y}z|Ah67]7r6!jH>CSR8);2V QCmIH5RG:W?uh @QM|' );
define( 'AUTH_SALT',        'FkVeFc%W]PMXX>#dXF77PP+~K@@*#M{+7p(,zy}v4mREA 9Ql)?r5 x/Z^%YiD%O' );
define( 'SECURE_AUTH_SALT', 'qH$nQ4x>{r4P3v4XuLI,b,r.fGKHPM $=RX/0qLnE#b9x+7w5 S395fi.{@xjT$4' );
define( 'LOGGED_IN_SALT',   ',LHVGn$F<D2MHaS}M.1zS=J&+mgu0IBHd1;*E8m|e6:4qDk9Y9wo1!#:X+Kspw @' );
define( 'NONCE_SALT',       '2uLC5|>[LJLvXMaB9#fg@4m5q0.Lb1bTpql/U[3>t]MUG~6|[+D<uW+CjR&ELioV' );
define('FS_METHOD',			'direct');
define('ALLOW_UNFILTERED_UPLOADS',true);

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

define('SCRIPTPATH','/phpChart/');
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
