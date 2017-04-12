<?php
/**
 * Класс-стратегия для аутентификации пользователя c помощью HTTP-Base
 *
 * @file      HttpBaseStrategy.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 14:28
 */

namespace Auth\Strategies;

use Exceptions\UnauthorizedException;
use Models\User;
use Veles\Exceptions\Http\UnprocessableException;
use Veles\Validators\NumberValidator;

/**
 * Class   HttpBaseStrategy
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class HttpBaseStrategy
{
	/** @var int  */
	protected $id;
	/** @var string  */
	protected $hash;
	/** @var User  */
	protected $user;

	/**
	 * Конструктор
	 *
	 * @param int    $id   ID пользователя из запроса
	 * @param string $hash Хэш пароля пользователя
	 * @param User   $user Модель пользователя
	 *
	 * @throws UnprocessableException
	 */
	public function __construct($id, $hash, User $user)
	{
		if (!(new NumberValidator)->check($id)) {
			throw new UnprocessableException(['message' => 'Not valid token']);
		}

		$this->id   = $id;
		$this->hash = $hash;
		$this->user = $user;
	}

	/**
	 * User authentication
	 *
	 * @return bool
	 * @throws UnauthorizedException
	 */
	public function identify()
	{
		$user =& $this->user;

		if (!$user->getById($this->id) || $user->getHash() !== $this->hash) {
			throw new UnauthorizedException;
		}

		return true;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}
}
