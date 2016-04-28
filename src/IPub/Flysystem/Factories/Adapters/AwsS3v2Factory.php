<?php
/**
 * AwsS3v2Factory.php
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
use Nette\DI;
use Nette\Utils;

use League\Flysystem;
use League\Flysystem\AwsS3v2;

use Aws\S3\S3Client;

/**
 * AWS S3 v2 adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class AwsS3v2Factory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return AwsS3v2\AwsS3Adapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container)
	{
		/** @var S3Client $client */
		$client = $container->getService($parameters->client);

		return new AwsS3v2\AwsS3Adapter(
			$client,
			$parameters->bucket,
			$parameters->prefix
		);
	}
}
