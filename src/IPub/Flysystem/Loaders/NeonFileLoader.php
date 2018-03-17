<?php
/**
 * NeonFileLoader.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Loaders
 * @since          1.0.0
 *
 * @date           12.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Loaders;

use Nette;
use Nette\Neon;
use Nette\Utils;

use IPub\Flysystem\Exceptions;

/**
 * Neon configuration files loader for Flysystem configuration
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Loaders
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class NeonFileLoader
{
	/**
	 * Implement nette smart magic
	 */
	use Nette\SmartObject;

	/**
	 * @param $resource
	 *
	 * @return array
	 */
	public function load($resource) : array
	{
		if (!stream_is_local($resource)) {
			throw new Exceptions\InvalidResourceException(sprintf('This is not a local file "%s".', $resource));
		}

		if (!file_exists($resource)) {
			throw new Exceptions\NotFoundResourceException(sprintf('File "%s" not found.', $resource));
		}

		try {
			$configuration = Neon\Neon::decode(file_get_contents($resource));

		} catch (Utils\NeonException $ex) {
			throw new Exceptions\InvalidResourceException(sprintf('Error parsing Neon: %s', $ex->getMessage()), 0, $ex);

		} catch (Nette\Neon\Exception $ex) {
			throw new Exceptions\InvalidResourceException(sprintf('Error parsing Neon: %s', $ex->getMessage()), 0, $ex);
		}

		if (empty($configuration)) {
			$configuration = [];
		}

		if (!is_array($configuration)) {
			throw new Exceptions\InvalidResourceException(sprintf('The file "%s" must contain a Neon array.', $resource));
		}

		return $configuration;
	}
}
