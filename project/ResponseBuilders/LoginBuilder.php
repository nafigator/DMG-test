<?php
/**
 * Построение ответа для логина пользователя
 *
 * @file      LoginBuilder.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 17:49
 */

namespace ResponseBuilders;

use ResponseBuilders\Base\AbstractResponseBuilder;

/**
 * Class   LoginBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class LoginBuilder extends AbstractResponseBuilder
{
	/**
	 * Построение ответа API
	 *
	 * @return $this
	 */
	public function build()
	{
		$data    = json_decode($this->result, true);
		$results = reset($data['results']);
		$face    = reset($results);

		$this->response = [
			'token' => base64_encode(
				$face['face']['id'] . ':' . $face['face']['photo_hash']
			)
		];

		return $this;
	}
}