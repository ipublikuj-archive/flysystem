<?php
/**
 * NullFactory.php
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

use League\Flysystem\Adapter;

/**
 * NULL adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class NullFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Adapter\NullAdapter
	 */
	public static function create(Utils\ArrayHash $parameters) : Adapter\NullAdapter
	{
		return new Adapter\NullAdapter;
	}
}
