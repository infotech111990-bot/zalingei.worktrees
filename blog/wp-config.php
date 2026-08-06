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
define( 'DB_NAME', 'zalingei_wp248' );

/** Database username */
define( 'DB_USER', 'zalingei_wp248' );

/** Database password */
define( 'DB_PASSWORD', 'Mx84S[9Op!' );

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
define( 'AUTH_KEY',         'dcgxo224qs4f6umpjzgvmwbntgh8yzadgwlpg1omovryyttwuggfw7ondkfvoccy' );
define( 'SECURE_AUTH_KEY',  'bjsmws6ac3geanukdkospmg5dgtmuxkbkfwdzxd9iipokacs9gumvcxejydwt7t3' );
define( 'LOGGED_IN_KEY',    'omdjr2ju2rqb0vqddnihygcn1i7i5g2hgbtguontkpbk3uakwws2h3rrzztctqzc' );
define( 'NONCE_KEY',        'ehrb0kte1mov81vxzo8kdpnvn3y9dquyah7xkldwra5h9b6wqy5grzngqwyshkww' );
define( 'AUTH_SALT',        'cmppojjkf9g2iikyw9bgkmtnv3wntjdeqzlar6mffcghynfrtolygkcurnzau1a5' );
define( 'SECURE_AUTH_SALT', 'tlav6ytmtemhb3mt46bwaded7rvv75r2akcf0uxbqnp33paf5qpea642cxnf82ea' );
define( 'LOGGED_IN_SALT',   'hhb9efb8kg7piaodupqdco6drypgh25bph28oxslgkcjyprh7pmkrttcorcz10mg' );
define( 'NONCE_SALT',       'w9tkrclhud6nwlc5iqjd9rmsqcoetqay5lh3a40nudjtquyz1wcfcd6uc05lpo1d' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpmx_';

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
