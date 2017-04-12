<?php
/**
 * Билдер для ответа регистрации
 *
 * @file      RegistrationBuilder.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 08:13
 */

namespace ResponseBuilders;

use ResponseBuilders\Base\AbstractResponseBuilder;

/**
 * Class   RegistrationBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class RegistrationBuilder extends AbstractResponseBuilder
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

		$data = json_decode($this->result, true);
		$results = $data['results'][0];

		$this->response = [
			'token' => base64_encode(
				$results['id'] . ':' . $results['photo_hash']
			)
		];
	}
}
