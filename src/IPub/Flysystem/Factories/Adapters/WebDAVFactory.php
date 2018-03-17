<?php
/**
 * WebDAVFactory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           23.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\DI;
use Nette\Utils;

use League\Flysystem\WebDAV;

use Sabre\DAV;

/**
 * WebDAV compress adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class WebDAVFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return WebDAV\WebDAVAdapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container) : WebDAV\WebDAVAdapter
	{
		/** @var DAV\Client $client */
		$client = $container->getService($parameters->client);

		return new WebDAV\WebDAVAdapter($client, $parameters->prefix);
	}
}
