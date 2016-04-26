<?php
/**
 * CachedFactory.php
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
use League\Flysystem\Cached;

/**
 * Cached adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class CachedFactory
{
	/**
	 * @param string $adapterServiceName
	 * @param string $cacheServiceName
	 * @param Nette\DI\Container $container
	 *
	 * @return Cached\CachedAdapter
	 */
	public static function create($adapterServiceName, $cacheServiceName, DI\Container $container)
	{
		/** @var Flysystem\AdapterInterface $adapter */
		$adapter = $container->getService($adapterServiceName);
		/** @var Cached\CacheInterface $cache */
		$cache = $container->getService($cacheServiceName);

		return new Cached\CachedAdapter($adapter, $cache);
	}
}
