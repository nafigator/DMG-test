<?php
/**
 * @file      RegistrationDefinition.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-11 22:08
 */

namespace Validators\Definitions;

/**
 * Class   RegistrationDefinition
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class RegistrationDefinition
{
	const POST = [
		'first_name'   => [
			'filter'   => FILTER_VALIDATE_REGEXP,
			'flags'    => FILTER_REQUIRE_SCALAR,
			'options'  => ['regexp' => '/^.{1,40}$/'],
			'required' => true
		],
		'last_name'    => [
			'filter'   => FILTER_VALIDATE_REGEXP,
			'flags'    => FILTER_REQUIRE_SCALAR,
			'options'  => ['regexp' => '/^.{1,40}$/'],
			'required' => true
		],
		'patronymic'   => [
			'filter'   => FILTER_VALIDATE_REGEXP,
			'flags'    => FILTER_REQUIRE_SCALAR,
			'options'  => ['regexp' => '/^.{1,40}$/'],
			'required' => true
		],
		'link'         => [
			'filter'   => FILTER_VALIDATE_URL,
			'flags'    => FILTER_REQUIRE_SCALAR
		]
	];
}
