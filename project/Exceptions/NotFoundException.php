<?php
/**
 * Исключение для ненайденных роутов
 *
 * @file      NotFoundException.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-02-01 21:34
 */

namespace Exceptions;

use Veles\Exceptions\Http\HttpResponseException;

/**
 * Class   NotFoundException
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class NotFoundException extends HttpResponseException
{
	public function __construct()
	{
		parent::__construct();

		header('HTTP/1.1 404 Not Found', true, 404);
	}
}
