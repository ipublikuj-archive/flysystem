<?php
/**
 * AzureFactory.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           23.04.16
 */

namespace IPub\Flysystem\Factories\Adapters;

use Nette;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\Azure;

use WindowsAzure\Common\ServicesBuilder;

/**
 * Azure adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class AzureFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Azure\AzureAdapter
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		$endpoint = sprintf(
			'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s',
			$parameters->account,
			$parameters->apiKey
		);

		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($endpoint);

		return new Azure\AzureAdapter(
			$blobRestProxy,
			$parameters->container
		);
	}
}
