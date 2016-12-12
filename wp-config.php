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
define('DB_NAME', 'wordpress_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'P@ssw0rd150994');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'jGEak1>-G:1@__F<nSv(Nj*f[ w8cxX_6R#2|r}c4icyj<rW>Gn%Vn (>p!1f/Z-');
define('SECURE_AUTH_KEY',  'qK+E>|}ETF4G|S[|t<$N$;zYnIwfqMNa?zS*23B>a~z,GA*D1EZUK+v~h#(ZBO=l');
define('LOGGED_IN_KEY',    'el!eA)ZtR>w*-m5x_QV3GHR:yYzN~@T,pLdo13f-7UlT0z6UC%qcK.ET{=]-1%9Z');
define('NONCE_KEY',        'epWfM3Roq_5+<Jf>om h2/yoW=M^bl$1y`{WkBI*L@I1&:[xBKCnX??E#k}MF9sh');
define('AUTH_SALT',        '}4kjNH{tP,5`Qv~+90|wj&wZ.GV7]3wBU_*bT.{GwkXIx ,ak%lVFfhZL2+uX6rS');
define('SECURE_AUTH_SALT', '}MStUE]s_GiZpZQOhb1$z-yTsx5$kSxnQ9Ylk!;4r:~d!1j^G7z{T]QI<AOpVz-J');
define('LOGGED_IN_SALT',   'uw,O3M)T/-Ja<4+6+Z+,8ie,+{KYj.s3:#F+WeIHdjgt@#1H19FVVA@ugp2vLbUj');
define('NONCE_SALT',       'd8DD}@YN%h#m@(H?5w.u#v{Z`SZ_e:3Q,~$JJZjyCWf!-g)MuM##E`Q>Y*f,Pa&]');

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
