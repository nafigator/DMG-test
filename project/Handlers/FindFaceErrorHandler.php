<?php
/**
 * Обработчик-декоратор ошибок API findface.pro
 *
 * @file      FindFaceErrorHandler.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 22:38
 */

namespace Handlers;

use Veles\CurlRequest\CurlRequest;
use Veles\Exceptions\Http\RuntimeException;
use Veles\Exceptions\Http\UnprocessableException;

/**
 * Class   FindFaceErrorHandler
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFaceErrorHandler
{
	/** @var CurlRequest  */
	protected $request;

	/**
	 * FindFaceErrorHandler constructor.
	 *
	 * @param CurlRequest $request
	 */
	public function __construct(CurlRequest $request)
	{
		$this->request = $request;
	}

	/**
	 * Декорируем вызов запроса для обработки ошибок API findface.pro
	 *
	 * @return string
	 */
	public function exec()
	{
		$request =& $this->request;
		$result  = $request->exec();

		if (200 !== ($code = $request->getInfo(CURLINFO_HTTP_CODE))) {
			$this->processCode($code, $result);
		}

		return $result;
	}

	/**
	 * Обрабатываем HTTP-код ответа
	 *
	 * @param int    $code
	 * @param string $result
	 *
	 * @throws RuntimeException
	 * @throws UnprocessableException
	 */
	protected function processCode($code, $result)
	{
		switch ($code) {
			case 400:
				if ($result['code'] === 'BAD_PARAM') {
					throw new UnprocessableException([[
						'message' => 'Bad params'
					]]);
				}

				throw new UnprocessableException;
				break;
			default:
				throw new RuntimeException;
				break;
		}
	}
}
