<?php
/**
 * MemoryFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 * @since          1.0.0
 *
 * @date           23.04.16
 */

namespace IPub\Flysystem\Factories\Cache;

use Nette;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Cached;

/**
 * Memory cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class MemoryFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Cached\Storage\Memory
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		return new Cached\Storage\Memory;
	}
}
