<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'viradadb');

/** MySQL database username */
define('DB_USER', 'wpuser');

/** MySQL database password */
define('DB_PASSWORD', 'Smc@2017');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

// NAS REDES
define('NAS_REDES__HOST', 'localhost');
define('NAS_REDES__USER', 'username_here');
define('NAS_REDES__PASS', 'password_here');
define('NAS_REDES__DB_NAME', 'nas_redes');

// MINHA VIRADA - FACEBOOK APP
define('FACEBOOK_APP_ID', '');
define('FACEBOOK_APP_SECRET', '');

define('MINHA_VIRADA_API_URL', '');

define('ITUNES_APP_ID', '');
define('GOOGLEPLAY_APP_ID', '');

// aparece nos fotters de notícias ou imprensa
define('SITE_COMUNICACAO', 'Maloca Dragão');

// valores possíveis: 'space', 'time', 'name'
define('PROGRAMACAO_DEFAULT_VIEWBY', 'space');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't1_gP,~-l2#q!X V{js/z<@r9W$HJyT?V-F5SvIb@E%d&|W8z-pju)6Y!|{(kEy}');
define('SECURE_AUTH_KEY',  'W7OfV$_8wBnjV:+dt)X3O]>~*`h~9H9+$|s@ogkPW3`|)&;*znw|R9wkF <-v|r[');
define('LOGGED_IN_KEY',    '~09t54hn?Gs{YojDM&1>(p9C(btCr3&z=wGsgU^~[Qi[t@MzZ|wTZy+Pr.+2y1Y!');
define('NONCE_KEY',        'f9<)>p+>KW:Qq=u0u`&4!Et&|Ik [39T4VZkZXb[7c74Y8_4WiO;c2Zmv{y(PW0U');
define('AUTH_SALT',        '/-*|+$Z9inhG;|?3a.%Y{arnQ&goei|qnxw* cZn$&CT+Z%(l~.SE(e_g:,c?/KZ');
define('SECURE_AUTH_SALT', 'p`&TroO`kB4,&`><U/*x)V_u#$-ZzY3k4F87]>LgLR=KN12!!:,&{@mYz}k0-5nw');
define('LOGGED_IN_SALT',   '!*E|P3^l`~z?K(,Fiqt|z+VejA1~FX7/DU+e $jYd9LCP-quh-:bT0~--Y=;6IH3');
define('NONCE_SALT',       'F*Vp:mVKp{]lGWZ$%+2dn(<ghtPnm97dQ>G@OW(!r!|0T~-bN}Cn%F`^O5Jx#&Cw');

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
