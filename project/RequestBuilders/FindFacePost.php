<?php
/**
 * Базовый класс для POST-запроса на findface.pro
 *
 * @file      FindFacePost.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 03:38
 */

namespace RequestBuilders;

use Veles\CurlRequest\PostCurlRequest;

/**
 * Class   FindFacePost
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFacePost extends PostCurlRequest
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
