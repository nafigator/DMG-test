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

use Request\FindFacePostFactory;
use ResponseBuilders\LoginBuilder;
use Validators\Definitions\LoginDefinition;
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

		//$fp = fopen('/tmp/var.dump', 'w+');
		//$options[CURLOPT_VERBOSE] = true;
		//$options[CURLOPT_STDERR]  = $fp;

		$request = (new FindFacePostFactory)->create('identify', $link, $options);
		$result  = $request->exec();

		//fclose($fp);

		return (new LoginBuilder)
			->setRequest($request)
			->setResult($result)
			->build()
			->getResponse();
	}
}