<?php
/**
 * Обозреватель событий от билдера ответа логина.
 *
 * @file      LoginHandler.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 20:41
 */

namespace Handlers;

use ResponseBuilders\LoginBuilder;
use SplObserver;
use SplSubject;
use Veles\Cache\Cache;
use Veles\Exceptions\Http\UnprocessableException;

/**
 * Class   LoginHandler
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class LoginHandler implements SplObserver
{
	const PREFIX = 'DMG:LOGIN:';
	const YEAR   = 31536000;

	/**
	 * Receive update from subject
	 *
	 * @link  http://php.net/manual/en/splobserver.update.php
	 *
	 * @param LoginBuilder|SplSubject $subject The SplSubject notifying the observer of an update.
	 *
	 * @return void
	 * @throws UnprocessableException
	 * @since 5.1.0
	 */
	public function update(SplSubject $subject)
	{
		$face = $subject->getFace();
		$key  = self::PREFIX . $face['id'];

		if (Cache::has($key)) {
			throw new UnprocessableException([[
				'message' => 'User already logged in'
			]]);
		}

		$ttl = $_SERVER['REQUEST_TIME'] + self::YEAR;
		Cache::set($key, $face['photo_hash'], $ttl);
	}
}
