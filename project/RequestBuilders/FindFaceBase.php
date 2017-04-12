<?php
/**
 * Базовый класс для запроса на findface.pro
 *
 * @file      FindFaceBase.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 03:38
 */

namespace RequestBuilders;

use Veles\CurlRequest\PostCurlRequest;

/**
 * Class   FindFaceBase
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFaceBase extends PostCurlRequest
{
	/** @var string API host */
	protected $host  = 'https://api.findface.pro';
	/** @var string Токен для доступа к API findface */
	protected $token = 'OWwh0_FUQlxx8StEJAS8fO3IL84EdGI2';
	/** @var string Версия API */
	protected $version = 'v0';

	public function __construct($url, array $options = [])
	{
		$complete_url = "$this->host/$this->version/$url/";
		$auth_header  = "Authorization: Token $this->token";

		$options[CURLOPT_HTTPHEADER][] = $auth_header;

		parent::__construct($complete_url, $options);
	}
}
