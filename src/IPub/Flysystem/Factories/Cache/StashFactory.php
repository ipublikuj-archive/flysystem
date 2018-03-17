<?php
/**
 * StashFactory.php
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

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Cache;

use Nette\DI;
use Nette\Utils;

use League\Flysystem\Cached;

use Stash;

/**
 * Stash cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class StashFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return Cached\Storage\Stash
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container) : Cached\Storage\Stash
	{
		/** @var Stash\Pool $pool */
		$pool = $container->getService($parameters->pool);

		return new Cached\Storage\Stash($pool, $parameters->key, $parameters->expires);
	}
}
