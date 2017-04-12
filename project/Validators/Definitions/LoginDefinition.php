<?php
/**
 * Аутентифицируем пользователя по фотографии
 *
 * @file      LoginDefinition.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 17:41
 */

namespace Validators\Definitions;

/**
 * Class   LoginDefinition
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class LoginDefinition
{
	const POST = [
		'link' => [
			'filter'   => FILTER_VALIDATE_URL,
			'flags'    => FILTER_REQUIRE_SCALAR
		]
	];
}