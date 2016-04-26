<?php
/**
 * AwsS3v3Factory.php
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
use League\Flysystem\AwsS3v3;

use Aws\S3\S3Client;

/**
 * AWS S3 v3 adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class AwsS3v3Factory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return AwsS3v3\AwsS3Adapter
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		$client = new S3Client(
			[
				'credentials' => [
					'key'    => $parameters->accessKey,
					'secret' => $parameters->accessSecret,
				],
				'region'      => $parameters->region,
				'version'     => $parameters->version,
			]
		);

		return new AwsS3v3\AwsS3Adapter(
			$client,
			$parameters->bucket,
			$parameters->prefix
		);
	}
}
