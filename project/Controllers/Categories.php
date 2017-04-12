<?php
/**
 * Контроллер для получения списка категорий
 *
 * @file      Categories.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 14:21
 */

namespace Controllers;

use Handlers\FindFaceErrorHandler;
use RequestBuilders\FindFaceGet;
use ResponseBuilders\CategoriesResponseBuilder;
use Veles\Controllers\RestApiController;

/**
 * Class   Categories
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class Categories extends RestApiController
{
	/**
	 * Получение категорий
	 */
	public function get()
	{
		$request = new FindFaceGet('galleries');
		$result  = (new FindFaceErrorHandler($request))->exec();

		return (new CategoriesResponseBuilder)
			->setRequest($request)
			->setResult($result)
			->build()
			->getResponse();
	}
}
