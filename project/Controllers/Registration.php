<?php
/**
 * Контроллер для регистрации нового пользователя
 *
 * @file      Registration.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-11 21:56
 */

namespace Controllers;

use Request\FindFacePostFactory;
use Validators\Definitions\RegistrationDefinition;
use Veles\Controllers\RestApiController;

/**
 * Class   Registration
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class Registration extends RestApiController
{
	/**
	 * Регистрируем пользователя
	 *
	 * @return array
	 */
	public function post()
	{
		$first_name = $last_name = $patronymic = $link = null;
		extract($this->getData(RegistrationDefinition::POST), EXTR_IF_EXISTS);

		$options[CURLOPT_POSTFIELDS] = [
			'meta'      => "$last_name $first_name $patronymic"
		];

		$fp = fopen('/tmp/var.dump', 'w+');
		$options[CURLOPT_VERBOSE] = true;
		$options[CURLOPT_STDERR]  = $fp;

		$request = (new FindFacePostFactory)->create('face', $link, $options);
		$result  = $request->exec();

		fclose($fp);

		return [];
	}
}
