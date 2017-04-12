<?php
/**
 * Абстрактный класс для построения ответа API
 *
 * @file      AbstractResponseBuilder.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 08:16
 */

namespace ResponseBuilders\Base;

use Veles\CurlRequest\CurlRequest;

/**
 * Class   AbstractResponseBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
abstract class AbstractResponseBuilder
{
	/** @var  CurlRequest $request */
	protected $request;
	protected $result;
	protected $response = [];

	/**
	 * Построение ответа API
	 *
	 * @return $this
	 */
	abstract public function build();

	/**
	 * Передаём в класс CurlRequest
	 *
	 * @param CurlRequest $request
	 *
	 * @return AbstractResponseBuilder
	 */
	public function setRequest(CurlRequest $request)
	{
		$this->request = $request;

		return $this;
	}

	/**
	 * Передаём в класс ответ API FindFace
	 *
	 * @param mixed $result
	 *
	 * @return AbstractResponseBuilder
	 */
	public function setResult($result)
	{
		$this->result = $result;

		return $this;
	}

	/**
	 * Получить ответ
	 *
	 * @return array
	 */
	public function getResponse()
	{
		return $this->response;
	}
}
