<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件并重命名为“wp-config.php”，然后输入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您的主机服务提供商 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', '4757594_wp1' );

/** MySQL数据库用户名 */
define( 'DB_USER', '4757594_wp1' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', 'Huaimeiting@2026' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 可以通过 https://api.wordpress.org/secret-key/1.1/salt/ 获得
 *
 * 您可以随意在每次发布时更改这些密钥。
 * 这将使所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L8x7T!^P+Q9#mR2$sK5@zW1*cV4&fG6%hJ0(gN3=dF8}aE7]bD9`yU2<jH1~kM0' );
define( 'SECURE_AUTH_KEY',  'Y6#tB4%rF1$sN8@mC7*pL3&qK2!wV0^xU5+dZ9(gH4)fE6}aS1~nM0<jR3`yT2' );
define( 'LOGGED_IN_KEY',    'X5$eD2#vG9!zN1%mF6*pK4&qL3@wU0^yV7+dZ8(hH5)fE9}aS2~nM1<jR4`yT3' );
define( 'NONCE_KEY',        'W4#cB1$vF8!yM0%lE5*oJ3&pK2@xT9^zU6+dY7(gH4)fD8}aR1~nL0<jQ3`wS2' );
define( 'AUTH_SALT',        'V3$bA0#uE7!xL9%kD4*nI2&oJ1@wS8^zT5+cX6(fG3)eC7}aQ0~mK9<jP2`vR1' );
define( 'SECURE_AUTH_SALT', 'U2!a@9$tD6#wK8%jC3*oH1&nI0@vR7^yS4+dW5(eF2)dB6}aP9~mL8<kO1`uQ0' );
define( 'LOGGED_IN_SALT',   'T1!z@8$sC5#vJ7%iB2*nG0&mH9@uQ6^xR3+cV4(dE1)aA5}oP8~lK7<jN0`tM9' );
define( 'NONCE_SALT',       'S0!y@7$rB4#uI6%hA1*mF9&nG8@tP5^wQ2+dU3(cD0)zZ4}oO7~lJ6<kM9`sL8' );

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置不同的数据表前缀。
 * 前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 有关其他常量的信息，请参阅Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* 好了！请不要再继续编辑。请保存此文件。 */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
