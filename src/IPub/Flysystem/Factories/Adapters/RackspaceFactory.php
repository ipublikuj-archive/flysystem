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
	const US_ENDPOINT = 'US';
	const UK_ENDPOINT = 'UK';

	const REGION_DFW = 'DFW';
	const REGION_IAD = 'IAD';
	const REGION_ORD = 'ORD';
	const REGION_LON = 'LON';
	const REGION_SYD = 'SYD';

	const URL_PUBLIC = 'public';
	const URL_INTERNAL = 'internal';

	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Rackspace\RackspaceAdapter
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		$client = new OpenCloud\OpenStack(self::getEndpoints()[$parameters->endpoint], [
			'username' => $parameters->username,
			'password' => $parameters->password,
		]);

		$region = $parameters->region ? self::getRegions()[$parameters->region] : NULL;
		$urlType = $parameters->urlType ? self::getUrls()[$parameters->urlType] : NULL;

		$store = $client->objectStoreService($parameters->serviceName, $region, $urlType);

		$container = $store->getContainer($parameters->container);

		return new Rackspace\RackspaceAdapter($container, $parameters->prefix);
	}

	/**
	 * @return array
	 */
	private static function getEndpoints()
	{
		return [
			self::US_ENDPOINT => OpenCloud\Rackspace::US_IDENTITY_ENDPOINT,
			self::UK_ENDPOINT => OpenCloud\Rackspace::UK_IDENTITY_ENDPOINT,
		];
	}

	/**
	 * @return array
	 */
	private static function getRegions()
	{
		return [
			self::REGION_DFW => 'DFW',
			self::REGION_IAD => 'IAD',
			self::REGION_ORD => 'ORD',
			self::REGION_LON => 'LON',
			self::REGION_SYD => 'SYD',
		];
	}

	/**
	 * @return array
	 */
	private static function getUrls()
	{
		return [
			self::URL_PUBLIC   => 'publicURL',
			self::URL_INTERNAL => 'internalURL',
		];
	}
}
