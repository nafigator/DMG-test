<?php
/**
 * Фабрика, которая создаёт объект запроса в зависимости от того, пришёл
 * файл или ссылка на него
 *
 * @file      FindFacePostFactory.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 04:37
 */

namespace Request;

use RequestBuilders\FindFaceJsonData;
use RequestBuilders\FindFaceMultipartData;
use Veles\Exceptions\Http\UnprocessableException;
use Veles\Validators\UploadedFileValidator;

/**
 * Class   FindFacePostFactory
 *
 * @author Yancharuk Alexander <alex at itvault at info>
 */
class FindFacePostFactory
{
	/**
	 * Создаём объект для POST-запроса
	 *
	 * @param       $uri
	 * @param       $link
	 * @param array $options
	 *
	 * @return FindFaceJsonData|FindFaceMultipartData
	 * @throws UnprocessableException
	 */
	public function create($uri, $link, array $options = [])
	{
		if (isset($link)) {
			$this->setPhotoByLink($link, $options);

			$request = new FindFaceJsonData($uri, $options);
		} else {
			if (!(new UploadedFileValidator)->check('file')) {
				throw new UnprocessableException([[
					'field'   => 'file',
					'message' => 'Not a valid image'
				]]);
			}

			$this->setPhotoByFile($options);

			$request = new FindFaceMultipartData($uri, $options);
		}

		return $request;
	}

	/**
	 * Передаём поле photo как ссылку
	 *
	 * @param string $link
	 * @param array  $options
	 */
	protected function setPhotoByLink($link, array &$options)
	{
		if (isset($options[CURLOPT_POSTFIELDS])) {
			$options[CURLOPT_POSTFIELDS] += ['photo' => $link];
		} else {
			$options[CURLOPT_POSTFIELDS] = ['photo' => $link];
		}
	}

	/**
	 * Передаём поле photo как файл
	 *
	 * @param array $options
	 */
	protected function setPhotoByFile(array &$options)
	{
		if (isset($options[CURLOPT_POSTFIELDS])) {
			$options[CURLOPT_POSTFIELDS] += [
				'photo'    => '@' . $_FILES['file']['tmp_name'],
				'filename' => $_FILES['file']['name']
			];
		} else {
			$options[CURLOPT_POSTFIELDS] = [
				'photo'    => '@' . $_FILES['file']['tmp_name'],
				'filename' => $_FILES['file']['name']
			];
		}

		$options[CURLOPT_INFILESIZE] = $_FILES['file']['size'];
	}
}
