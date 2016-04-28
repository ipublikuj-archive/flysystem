<?php
/**
 * RackspaceFactory.php
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
use Nette\DI;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Rackspace;

use OpenCloud;

/**
 * Rackspace adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class RackspaceFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return Rackspace\RackspaceAdapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container)
	{
		/** @var OpenCloud\ObjectStore\Resource\Container $client */
		$client = $container->getService($parameters->client);

		return new Rackspace\RackspaceAdapter($client, $parameters->prefix);
	}
}
