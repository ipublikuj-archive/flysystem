<?php
/**
 * AdapterFactory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 * @since          1.0.0
 *
 * @date           26.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Cache;

use Nette\DI;
use Nette\Utils;

use League\Flysystem\Cached;

/**
 * Adapter cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class AdapterFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return Cached\Storage\Adapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container) : Cached\Storage\Adapter
	{
		/** @var Flysystem\AdapterInterface $adapter */
		$adapter = $container->getService($parameters->extensionPrefix . '.adapters.' . $parameters->adapter);

		return new Cached\Storage\Adapter($adapter, $parameters->file, $parameters->expires);
	}
}
