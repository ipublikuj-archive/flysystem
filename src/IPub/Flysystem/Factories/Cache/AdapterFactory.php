<?php
/**
 * AdapterFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 * @since          1.0.0
 *
 * @date           26.04.16
 */

namespace IPub\Flysystem\Factories\Cache;

use Nette;
use Nette\DI;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Cached;

/**
 * Adapter cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class AdapterFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return Cached\Storage\Adapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container)
	{
		/** @var Flysystem\AdapterInterface $adapter */
		$adapter = $container->getService($parameters->extensionPrefix . '.adapters.' . $parameters->adapter);

		return new Cached\Storage\Adapter($adapter, $parameters->file, $parameters->expires);
	}
}
