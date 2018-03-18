<?php
/**
 * ZipFactory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           23.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\Utils;

use League\Flysystem\ZipArchive;

/**
 * ZIP compress adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class ZipFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return ZipArchive\ZipArchiveAdapter
	 */
	public static function create(Utils\ArrayHash $parameters) : ZipArchive\ZipArchiveAdapter
	{
		return new ZipArchive\ZipArchiveAdapter($parameters->location, $parameters->archive, $parameters->prefix);
	}
}
