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
use Veles\Request\RequestFactory;
use Veles\Request\Validator\PhpFilters;
use Veles\Request\Validator\Validator;
use Veles\Routing\IniConfigLoader;
use Veles\Routing\Route;
use Veles\Routing\RoutesConfig;

$version = '0.1.0';
header("X-Powered-By: DMG-test/$version", true);

ini_set('html_errors', 0);
ini_set('display_errors', E_ALL);

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

$request = RequestFactory::create($_SERVER['CONTENT_TYPE'])
	->setValidator((new Validator)->setAdapter(new PhpFilters));

(new Application)
	->setEnvironment((new Environment)->setName('dev'))
	->setRequest($request)
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
