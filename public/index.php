<?php
/**
 * Точка входа
 *
 * @file      index.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-11 20:45
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
use Veles\Routing\RoutesCacheDecorator;
use Veles\Routing\RoutesConfig;
use Veles\View\Adapters\NativeAdapter;

$version = '0.0.1';
header("X-Powered-By: DMG-test/$version", true);

$path = dirname(__DIR__);

include "$path/lib/Veles/AutoLoader.php";
set_include_path(
	implode(PATH_SEPARATOR, ["$path/lib:$path/project", get_include_path()])
);
AutoLoader::init();

MemcachedAdapter::addCall('addServer', ['localhost', 11211]);
Cache::setAdapter(MemcachedAdapter::instance());

// Параметры соединения с базой
$pool = new ConnectionPool();
$conn = new PdoConnection('master');
$conn->setDsn('mysql:host=localhost;dbname=dmg;charset=utf8')
	->setUserName('dmg')
	->setPassword('_GRcshGYyvUu')
	->setOptions([
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode=ANSI'
	]);
$pool->addConnection($conn, true);
Db::setAdapter((new PdoAdapter)->setPool($pool));

$config = new RoutesCacheDecorator(
	new RoutesConfig(new IniConfigLoader("$path/project/routes.ini"))
);
$config->setPrefix('DMG-test::ROUTES_CONFIG');
$route = new Route;
$route
	->setNotFoundException('\Exceptions\NotFoundException')
	->setConfigHandler($config)
	->init();

(new Application)
	->setEnvironment((new Environment)->setName('prod'))
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
