<?php
/**
 * Точка входа в проект для dev-окружения
 *
 * @file      index-dev.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-11 21:33
 */

use Veles\Application\Application;
use Veles\Application\Environment;
use Veles\AutoLoader;
use Veles\Cache\Adapters\MemcachedAdapter;
use Veles\Cache\Cache;
use Veles\DataBase\Adapters\PdoAdapter;
use Veles\DataBase\ConnectionPools\ConnectionPool;
use Veles\DataBase\Connections\PdoConnection;
use Veles\DataBase\Db;
use Veles\Routing\IniConfigLoader;
use Veles\Routing\Route;
use Veles\Routing\RoutesConfig;
use Veles\View\Adapters\NativeAdapter;

$version = '0.0.1';
header("X-Powered-By: DMG-test/$version", true);

ini_set('html_errors', 0);

$path = dirname(__DIR__);

include "$path/lib/Veles/AutoLoader.php";
set_include_path(
	implode(PATH_SEPARATOR, ["$path/lib:$path/project", get_include_path()])
);
AutoLoader::init();

MemcachedAdapter::addCall('addServer', ['localhost', 11211]);
Cache::setAdapter(MemcachedAdapter::instance());

$config = new RoutesConfig(new IniConfigLoader("$path/project/routes.ini"));
$route  = new Route;
$route
	->setNotFoundException('\Exceptions\NotFoundException')
	->setConfigHandler($config)
	->init();

(new Application)
	->setEnvironment((new Environment)->setName('dev'))
	->setRoute($route)
	->setVersion($version)
	->run();

// Функция для дампа отладочных данных
function d() {
	if (0 === func_num_args()) {
		return;
	}

	foreach (func_get_args() as $arg) {
		error_log(var_export($arg, true), 3, '/tmp/var.dump');
	}
}
