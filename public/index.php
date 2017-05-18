<?php
error_reporting(E_ALL);
ini_set('phalcon.orm.not_null_validations', 'on');
//ini_set('zlib.output_compression', 'Off');
(new \Phalcon\Debug)->listen();
define('BASE_DIR', dirname(__DIR__));
require_once BASE_DIR . '/vendor/autoload.php';
$config = include BASE_DIR . "/config/config.php";
include BASE_DIR . '/config/services.php';
//include BASE_DIR . '/config/bus_services.php';

/**
 * Handle the request
 */
$application = new \Phalcon\Mvc\Application();
$application->setDI($di);
/**
 * Register application modules
 */
//识别手机用户
$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
$mobile_browser = '0';
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
    $mobile_browser++;
if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
    $mobile_browser++;
if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
    $mobile_browser++;
if (isset($_SERVER['HTTP_PROFILE']))
    $mobile_browser++;
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
    'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
    'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
    'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
    'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
    'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
    'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
    'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
    'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
);
if (in_array($mobile_ua, $mobile_agents))
    $mobile_browser++;
if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
    $mobile_browser++;
// Pre-final check to reset everything if the user is on Windows
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
    $mobile_browser = 0;
// But WP7 is also Windows, with a slightly different characteristic
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
    $mobile_browser++;
if ($mobile_browser > 0) {
    define('is_mobile', true);
    define('view_type', 'mobile');
}else {
    define('is_mobile', false);
    define('view_type', 'pc');
}
$application->registerModules([
    'front' => [
        'className' => 'Phasty\Front\Module',
        'path' => BASE_DIR . '/app/Front/Module.php',
    ],
    'admin' => [
        'className' => 'Phasty\Admin\Module',
        'path' => BASE_DIR . '/app/Admin/Module.php',
    ]]);
//var_dump($di);die;
try {
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

