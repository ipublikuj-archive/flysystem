<?php
/**
 * MemoryFactory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           23.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\Utils;

use League\Flysystem\Memory;

/**
 * Memory adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class MemoryFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Memory\MemoryAdapter
	 */
	public static function create(Utils\ArrayHash $parameters) : Memory\MemoryAdapter
	{
		return new Memory\MemoryAdapter;
	}
}
