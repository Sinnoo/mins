<?php
/*
 * 入口文件
 * 加载函数类,启动框架
 * @date 08/05/17 15:42:24
 */
define("MINS", realpath('./'));
define("CORE", MINS.'/core/');
define("APP", MINS.'/app/');
define("DEBUG", true);

if (DEBUG) {
    ini_set('display_error', true);
} else {
    ini_set('display_error', false);
}

include CORE. 'common/basis.php';
include CORE. 'mins.php';

spl_autoload_register('core\mins::load');
#启动框架
\core\mins::run();

?>
