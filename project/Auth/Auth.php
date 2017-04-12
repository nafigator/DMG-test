<?php
/**
 * Контроллер
 *
 * @file      Auth.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 14:24
 */

namespace Auth;

use Auth\Strategies\HttpBaseStrategy;
use Exceptions\UnauthorizedException;
use Models\User;
use Veles\Auth\UsrAuth;

/**
 * Class   Auth
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class Auth extends UsrAuth
{
	/** @var  $this */
	protected static $instance;

	protected function __construct()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
			throw new UnauthorizedException();
		}

		//TODO Написать декоратор для кэширования пользователя
		$this->strategy = new HttpBaseStrategy(
			(int) $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], new User
		);

		$this->identified = $this->strategy->identify();
	}
}