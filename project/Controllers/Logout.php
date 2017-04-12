<?php
/**
 * Контроллер для логаута
 *
 * @file      Logout.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 21:58
 */

namespace Controllers;

use Handlers\LoginHandler;
use Veles\Cache\Cache;
use Veles\Exceptions\Http\UnprocessableException;

/**
 * Class   Logout
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class Logout extends AuthController
{
	/**
	 * Разлогиниваем пользователя
	 */
	public function post()
	{
		$key = LoginHandler::PREFIX . $this->user->getId();

		if (!Cache::has($key)) {
			throw new UnprocessableException([[
				'message' => 'User not logged in'
			]]);
		}

		Cache::del($key);
	}
}
