<?php
/**
 * Трейт для хранения аутентификационных данных для API findface.pro
 *
 * @file      CredentialsTrait.php
 *
 * PHP version 5.6+
 *
 * @author    Yancharuk Alexander <alex at itvault dot info>
 * @date      2017-04-12 15:14
 */

namespace RequestBuilders;

/**
 * Trait CredentialsTrait
 *
 * @author   Yancharuk Alexander <alex at itvault at info>
 */
trait CredentialsTrait
{
	/** @var string API host */
	protected $host  = 'https://api.findface.pro';
	/** @var string Токен для доступа к API findface */
	protected $token = 'OWwh0_FUQlxx8StEJAS8fO3IL84EdGI2';
	/** @var string Версия API */
	protected $version = 'v0';
}