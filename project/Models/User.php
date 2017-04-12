<?php
/**
 * Модель для пользователя
 *
 * @file      User.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 14:50
 */

namespace Models;

use RequestBuilders\FindFaceBase;
use RequestBuilders\FindFaceGet;
use Veles\Traits\DynamicPropHandler;

/**
 * Class   User
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class User extends UserBase
{
	use DynamicPropHandler;

	/**
	 * Получение пользователя по ID
	 *
	 * @param int $id
	 * @return $this
	 */
	public function getById($id)
	{
		$request = new FindFaceGet("face/id/$id");
		$result  = $request->exec();

		if (0 !== $request->getErrorCode()) {
			//TODO Обработка ошибок
		}

		$image = json_decode($result, true);
		list($last_name, $first_name, $patronymic) = explode(' ', $image['meta']);

		$this->setProperties([
			'id'         => $image['id'],
			'hash'       => $image['photo_hash'],
			'first_name' => $first_name,
			'last_name'  => $last_name,
			'patronymic' => $patronymic
		]);

		return $this;
	}
}