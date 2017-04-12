<?php
/**
 * Базовый контроллер для методов требующих авторизацию
 *
 * @file      AuthController.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 15:49
 */

namespace Controllers;

use Auth\Auth;
use Exceptions\UnauthorizedException;
use Veles\Controllers\RestApiController;

/**
 * Class   AuthController
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class AuthController extends RestApiController
{
	protected $user;

	/**
	 * Проверяем аутентификацию
	 *
	 * @throws UnauthorizedException
	 */
	public function index()
	{
		$this->user = Auth::getUser();

		return parent::index();
	}
}