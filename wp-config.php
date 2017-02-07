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
define('DB_NAME', 'camvcan_wp1');

/** MySQL database username */
define('DB_USER', 'camvcan_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'O.mQtwOT&@ssLXBxE&~93(@7');

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
define('AUTH_KEY',         'nzyUuOEhyUrnnK4KqQC2PFuGPkkpGQyLgOtsP6nxC5M5dCsHxYpZgM2wF9uE3DJh');
define('SECURE_AUTH_KEY',  'QzdOt4psI5oDdeepsflYvAmygnhb4B2ouXp3fWs13mMouArOv5NS2DvYsTkxOSgo');
define('LOGGED_IN_KEY',    'X7WqJwfqbvVwipYwf4ZZeFURGnLLlR4pMaOV3v3vMHc1SA3128XX8gwanKEXn75C');
define('NONCE_KEY',        '1RiKVCl8OHATSK9BU5XtixRJHkK1wDo8ZIDI1gxx7Rfp1CwxImiVgbh62LsA1Iqs');
define('AUTH_SALT',        'PJZAaE9hG9wmt335Fx5lgs21o29mDswNjtlmESIuWAPJvb2NUcbnmMofOYgk23VZ');
define('SECURE_AUTH_SALT', '69cY1GeuHnv4wPSSTmkrOaK4vUsC4TQARmdBRizey4aNFYGqNqXVGLQveKp1se7L');
define('LOGGED_IN_SALT',   'tOJX5jwThxeAktqqf3zDz6EEbK9n88XbVjB3kA1dozYzkvBjuoabsvDQO0mUNfM4');
define('NONCE_SALT',       'FXuLAVurw76REdE2az3dW84iOobDjqxIU2Gg9WJ9gapD68tCuibqSLS6U339XUZ0');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
