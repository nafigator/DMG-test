<?php
/**
 * Билдер для запроса списка категорий
 *
 * @file      CategoriesResponseBuilder.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 16:01
 */

namespace ResponseBuilders;

use ResponseBuilders\Base\AbstractResponseBuilder;

/**
 * Class   CategoriesResponseBuilder
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class CategoriesResponseBuilder extends AbstractResponseBuilder
{
	/**
	 * Построение ответа API
	 *
	 * @return $this
	 */
	public function build()
	{
		$data = json_decode($this->result, true);

		$this->response['categories'] = $data['results'];

		return $this;
	}
}
