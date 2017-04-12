<?php
/**
 * Базовый класс для модели данных пользователя
 *
 * @file      UserBase.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 14:45
 */

namespace Models;

/**
 * Class   UserBase
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class UserBase
{
	protected $id;
	protected $hash;
	protected $first_name;
	protected $last_name;
	protected $patronymic;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getHash()
	{
		return $this->hash;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName()
	{
		return $this->first_name;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->last_name;
	}

	/**
	 * @return mixed
	 */
	public function getPatronymic()
	{
		return $this->patronymic;
	}
}