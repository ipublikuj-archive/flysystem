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

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\Utils;

use League\Flysystem\Adapter;

/**
 * Local adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class LocalFactory
{
	private const SKIP_LINKS = 'skipLinks';
	private const DISALLOW_LINKS = 'disallowLinks';

	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Adapter\Local
	 */
	public static function create(Utils\ArrayHash $parameters) : Adapter\Local
	{
		return new Adapter\Local(
			$parameters->directory,
			$parameters->writeFlags,
			self::getLinks()[$parameters->linkHandling]
		);
	}

	/**
	 * @return array
	 */
	private static function getLinks() : array
	{
		return [
			self::SKIP_LINKS     => Adapter\Local::SKIP_LINKS,
			self::DISALLOW_LINKS => Adapter\Local::DISALLOW_LINKS,
		];
	}
}
