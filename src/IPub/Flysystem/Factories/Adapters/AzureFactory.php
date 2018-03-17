<?php
/**
 * AzureFactory.php
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

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\DI;
use Nette\Utils;

use League\Flysystem\Azure;

use WindowsAzure\Blob\Internal\IBlob;

/**
 * Azure adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class AzureFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return Azure\AzureAdapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container) : Azure\AzureAdapter
	{
		/** @var IBlob $client */
		$client = $container->getService($parameters->client);

		return new Azure\AzureAdapter(
			$client,
			$parameters->container,
			$parameters->prefix
		);
	}
}
