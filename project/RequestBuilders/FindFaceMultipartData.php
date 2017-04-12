<?php
/**
 * Запрос с контентом multipart/form-data
 *
 * @file      FindFaceMultipartData.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 04:10
 */

namespace RequestBuilders;

/**
 * Class   FindFaceMultipartData
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFaceMultipartData extends FindFaceBase
{
	public function __construct($url, array $options = [])
	{
		$options[CURLOPT_HTTPHEADER][] = 'Content-Type: multipart/form-data';

		parent::__construct($url, $options);
	}
}
