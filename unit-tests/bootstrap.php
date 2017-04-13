<?php
/**
 * Environment initialisation for unit-tests
 *
 * @file      bootstrap.php
 *
 * PHP version 5.6+
 *
 * @author    Alexander Yancharuk <alex at itvault dot info>
 * @copyright © 2012-2017 Alexander Yancharuk
 * @date      Чтв Дек 20 12:22:58 2012
 */

namespace Veles\Tests;

use Veles\AutoLoader;
use Veles\Cache\Adapters\MemcachedAdapter;
use Veles\Cache\Adapters\MemcacheRaw;
use Veles\Cache\Cache;

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

define('LIB_DIR', realpath(__DIR__ . '/../lib'));
define('TEST_DIR', realpath(__DIR__ . '/Tests'));
define('PROJECT_DIR', realpath(__DIR__ . '/../project'));

date_default_timezone_set('Europe/Moscow');

require LIB_DIR . '/Veles/AutoLoader.php';
$includes = PROJECT_DIR . ':' . LIB_DIR . ':' . TEST_DIR;
set_include_path(implode(PATH_SEPARATOR, [$includes, get_include_path()]));

AutoLoader::init();

// Cache initialization
MemcacheRaw::setConnectionParams('localhost', 11211);
MemcachedAdapter::addCall('addServer', ['localhost', 11211]);
Cache::setAdapter(MemcachedAdapter::instance());
