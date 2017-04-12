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
use Veles\Traits\Observable;

/**
 * Class   LoginBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class LoginBuilder extends AbstractResponseBuilder
{
	use Observable;

	protected $face;

	/**
	 * Построение ответа API
	 *
	 * @return $this
	 */
	public function build()
	{
		$data    = json_decode($this->result, true);
		$results = reset($data['results']);
		$array   = reset($results);
		$face    = $array['face'];

		$this->response = [
			'token' => base64_encode($face['id'] . ':' . $face['photo_hash'])
		];

		$this->setFace($face)->notify();

		return $this;
	}

	/**
	 * Получить данные найденного фото
	 *
	 * @return mixed
	 */
	public function getFace()
	{
		return $this->face;
	}

	/**
	 * Сохраняем данные найденного фото
	 *
	 * @param mixed $face
	 *
	 * @return $this
	 */
	public function setFace($face)
	{
		$this->face = $face;

		return $this;
	}
}
