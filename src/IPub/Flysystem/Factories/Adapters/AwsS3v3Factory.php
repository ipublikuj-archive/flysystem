<?php
/**
 * AwsS3v3Factory.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 * @since          1.0.0
 *
 * @date           19.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Factories\Adapters;

use Nette\DI;
use Nette\Utils;

use League\Flysystem\AwsS3v3;

use Aws\S3\S3Client;

/**
 * AWS S3 v3 adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class AwsS3v3Factory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 * @param DI\Container $container
	 *
	 * @return AwsS3v3\AwsS3Adapter
	 */
	public static function create(Utils\ArrayHash $parameters, DI\Container $container) : AwsS3v3\AwsS3Adapter
	{
		/** @var S3Client $client */
		$client = $container->getService($parameters->client);

		return new AwsS3v3\AwsS3Adapter(
			$client,
			$parameters->bucket,
			$parameters->prefix
		);
	}
}
