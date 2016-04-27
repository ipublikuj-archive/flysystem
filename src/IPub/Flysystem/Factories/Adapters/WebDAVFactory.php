<?php
/**
 * WebDAVFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           23.04.16
 */

namespace IPub\Flysystem\Factories\Adapters;

use Nette;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\WebDAV;

use Sabre\DAV;

/**
 * WebDAV compress adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class WebDAVFactory
{
	const AUTH_TYPE_BASIC = 'basic';
	const AUTH_TYPE_DIGEST = 'digest';

	const ENCODING_IDENTITY = 'identity';
	const ENCODING_DEFLATE = 'deflate';
	const ENCODING_GZIP = 'gzip';

	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return WebDAV\WebDAVAdapter
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		$client = new DAV\Client([
			'baseUri'  => $parameters->baseUri,
			'proxy'    => $parameters->proxy,
			'userName' => $parameters->username,
			'password' => $parameters->password,
			'authType' => $parameters->authType ? self::getAutTypes()[$parameters->authType] : NULL,
			'encoding' => $parameters->encoding ? self::getEncodings()[$parameters->encoding] : NULL,
		]);

		return new WebDAV\WebDAVAdapter($client, $parameters->prefix);
	}

	/**
	 * @return array
	 */
	private static function getAutTypes()
	{
		return [
			self::AUTH_TYPE_BASIC  => DAV\Client::AUTH_BASIC,
			self::AUTH_TYPE_DIGEST => DAV\Client::AUTH_DIGEST,
		];
	}

	/**
	 * @return array
	 */
	private static function getEncodings()
	{
		return [
			self::ENCODING_IDENTITY => DAV\Client::ENCODING_IDENTITY,
			self::ENCODING_DEFLATE  => DAV\Client::ENCODING_DEFLATE,
			self::ENCODING_GZIP     => DAV\Client::ENCODING_GZIP,
		];
	}
}
