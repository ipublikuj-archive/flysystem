<?php
/**
 * NoopFactory.php
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

use Nette\Utils;

use League\Flysystem\Cached;

/**
 * Noop cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class NoopFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Cached\Storage\Noop
	 */
	public static function create(Utils\ArrayHash $parameters) : Cached\Storage\Noop
	{
		return new Cached\Storage\Noop;
	}
}
