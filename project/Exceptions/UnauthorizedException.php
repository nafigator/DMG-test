<?php
/**
 * @file      UnauthorizedException.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-01-22 12:53
 */

namespace Exceptions;

/**
 * Class   UnauthorizedException
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class UnauthorizedException extends \Veles\Exceptions\Http\UnauthorizedException
{
	protected $realm = 'DMG-test';
	protected $type  = 'Basic';
}
