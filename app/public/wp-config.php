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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n0ByeI5bedrDO2G2BCSICw6RgSgADo50gkp/GAOk+sX34OtgbPmeynSUaMxDBYgmfg+I1AM1oik2E47NvMYbUQ==');
define('SECURE_AUTH_KEY',  'dTBXLVbW9+b7Fb9jAcQcdk8DgvgYqvLXe3jtOR352hxRK/H/+D23TmqEOUQ56L86QxMApc01fPEQvX++a6vvYw==');
define('LOGGED_IN_KEY',    'gEYqQQeMYRRi857aCL0JpLzrbg1+jXo/4+oPjHkI1JtAGVGwd38nx3CvCtwDhxAxH3o9p+IyKWbyil6qU8PEnA==');
define('NONCE_KEY',        'Zc5QsRcR6J/fncAycYGR38I6HAe05GUlo5nc7b6E9rDvoLMvZMAlaLh7bqJBgXAVn5hCNPPt6gUAjhsHWMQSMg==');
define('AUTH_SALT',        'vf138XhoqrzieBWJ640ekqn07S2iYyuSbQ/XIUUMmEt2HciZipq9yBuDti8JcT6Dx9WMcw0Amt8ddzOXq4BU4w==');
define('SECURE_AUTH_SALT', 'GXYX/kSpKWsRYJp9M9I0Q6msrVx447CQlBC7dl68vLmS9BccMtjDoafH7RQ7Yy2uMXoQVxtgLHtC5Rw/5PD8vg==');
define('LOGGED_IN_SALT',   'KMNxUHKUrf8n4jgcblYY1GDJx7utxk98/8zgR4jtfKsanSvoZDtZ/evoUiMkuObnMUFJVf2PIUpxXI/r/dMBtQ==');
define('NONCE_SALT',       'xzi2T14mssEvSE6xYa414/1Edw9SL5Z++dBxuhHhYXg21bXHQp1Ss9vYc1QdLIeivwgg2R6vec1ttF7ykRgUrA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
