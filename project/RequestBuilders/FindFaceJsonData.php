<?php
/**
 * Запрос с контентом application/json
 *
 * @file      FindFaceJsonData.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 04:44
 */

namespace RequestBuilders;

/**
 * Class   FindFaceJsonData
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFaceJsonData extends FindFacePost
{
	public function __construct($url, array $options = [])
	{
		$options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';

		parent::__construct($url, $options);
	}

	/**
	 * Переопределяем базовый метод, чтобы тело запроса уходило как JSON
	 *
	 * @param $option
	 * @param $value
	 *
	 * @return $this
	 */
	public function setOption($option, $value)
	{
		if (CURLOPT_POSTFIELDS === $option) {
			$value = json_encode($value);
		}

		$this->options[$option] = $value;
		curl_setopt($this->curl, $option, $value);

		return $this;
	}

	/**
	 * Переопределяем базовый метод, чтобы тело запроса уходило как JSON
	 *
	 * @param array $options
	 *
	 * @return $this
	 */
	public function setArrayOptions(array $options)
	{
		foreach ($options as $option => $value) {
			if (CURLOPT_POSTFIELDS === $option) {
				$value = json_encode($value);
			}

			$this->options[$option] = $value;
		}

		curl_setopt_array($this->curl, $this->options);

		return $this;
	}
}
