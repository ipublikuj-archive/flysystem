<?php
/**
 * MemoryFactory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 * @since          1.0.0
 *
 * @date           23.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Cache;

use Nette\Utils;

use League\Flysystem\Cached;

/**
 * Memory cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class MemoryFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Cached\Storage\Memory
	 */
	public static function create(Utils\ArrayHash $parameters) : Cached\Storage\Memory
	{
		return new Cached\Storage\Memory;
	}
}
