<?php
/**
 * Билдер для ответа регистрации
 *
 * @file      RegistrationResponseBuilder.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 08:13
 */

namespace ResponseBuilders;

use ResponseBuilders\Base\AbstractResponseBuilder;

/**
 * Class   RegistrationResponseBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class RegistrationResponseBuilder extends AbstractResponseBuilder
{
	/**
	 * Построение ответа API
	 *
	 * @return $this
	 */
	public function build()
	{
		//TODO Проверка кода ответа и exceptions
		header('HTTP/1.1 201 Created', true, 201);

		$data    = json_decode($this->result, true);
		$results = reset($data['results']);

		$this->response = [
			'token' => base64_encode(
				$results['id'] . ':' . $data['results'][0]['photo_hash']
			)
		];
	}
}
