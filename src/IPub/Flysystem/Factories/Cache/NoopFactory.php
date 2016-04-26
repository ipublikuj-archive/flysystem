<?php
/**
 * NoopFactory.php
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
 * Noop cache
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Cache
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class NoopFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Cached\Storage\Noop
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		return new Cached\Storage\Noop();
	}
}
