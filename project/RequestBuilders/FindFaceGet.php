<?php
/**
 * Базовый класс для GET-запроса на findface.pro
 *
 * @file      FindFaceGet.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 15:13
 */

namespace RequestBuilders;

use Veles\CurlRequest\CurlRequest;

/**
 * Class   FindFaceGet
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFaceGet extends CurlRequest
{
	use CredentialsTrait;

	public function __construct($url, array $options = [])
	{
		$complete_url = "$this->host/$this->version/$url/";
		$auth_header  = "Authorization: Token $this->token";

		$options[CURLOPT_HTTPHEADER][] = $auth_header;

		parent::__construct($complete_url, $options);
	}
}