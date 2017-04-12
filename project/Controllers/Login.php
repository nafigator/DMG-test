<?php
/**
 * Контроллер для аутентификации пользователя по фотографии
 *
 * @file      Login.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 17:21
 */

namespace Controllers;

use Handlers\LoginHandler;
use Request\FindFacePostFactory;
use ResponseBuilders\LoginBuilder;
use Validators\Definitions\LoginDefinition;
use Veles\Cache\Cache;
use Veles\Controllers\RestApiController;

/**
 * Class   Login
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class Login extends RestApiController
{
	/**
	 * Аутентифицируем пользователя по фото
	 */
	public function post()
	{
		$link = null;
		extract($this->getData(LoginDefinition::POST), EXTR_IF_EXISTS);

		$options[CURLOPT_POSTFIELDS] = [
			'mf_selector' => 'reject'
		];

		$request = (new FindFacePostFactory)->create('identify', $link, $options);
		$result  = $request->exec();
		$builder = new LoginBuilder;
		$builder->attach(new LoginHandler);

		return $builder
			->setRequest($request)
			->setResult($result)
			->build()
			->getResponse();
	}
}
