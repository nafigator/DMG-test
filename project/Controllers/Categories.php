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
		$result  = $request->exec();

		if (0 !== $request->getErrorCode()) {
			//TODO Обработка ошибок
		}

		return (new CategoriesResponseBuilder)
			->setRequest($request)
			->setResult($result)
			->build()
			->getResponse();
	}
}
