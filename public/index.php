<?php
define('ABS_PATH', __DIR__.'/../');

include ABS_PATH . '/autoloader.php';

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = new \Uph\Miklaj\App();
$app->bootstrap();
?>
