<?php
/**
 * LocalFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           12.04.16
 */

namespace IPub\Flysystem\Factories\Adapters;

use Nette;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Adapter;

/**
 * Local adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class LocalFactory
{
	const SKIP_LINKS = 'skipLinks';
	const DISALLOW_LINKS = 'disallowLinks';

	const LINKS = [
		self::SKIP_LINKS     => Adapter\Local::SKIP_LINKS,
		self::DISALLOW_LINKS => Adapter\Local::DISALLOW_LINKS,
	];

	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Adapter\Local
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		return new Adapter\Local(
			$parameters->directory,
			$parameters->writeFlags,
			self::LINKS[$parameters->linkHandling]
		);
	}
}
