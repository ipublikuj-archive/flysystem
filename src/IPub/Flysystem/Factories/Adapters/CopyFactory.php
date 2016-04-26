<?php
/**
 * CopyFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           19.04.16
 */

namespace IPub\Flysystem\Factories\Adapters;

use Nette;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Copy;

use Barracuda\Copy\API;

/**
 * Copy.com adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class CopyFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Copy\CopyAdapter
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		// Crate copy.com client
		$client = new API($parameters->consumerKey, $parameters->consumerSecret, $parameters->accessToken, $parameters->tokenSecret);

		return new Copy\CopyAdapter(
			$client,
			$parameters->prefix
		);
	}
}
