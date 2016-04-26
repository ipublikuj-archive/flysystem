<?php
/**
 * FtpFactory.php
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
use League\Flysystem\Adapter;

/**
 * FTP adapter filesystem factory
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Adapters
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class FtpFactory
{
	/**
	 * @param Utils\ArrayHash $parameters
	 *
	 * @return Adapter\Ftp
	 */
	public static function create(Utils\ArrayHash $parameters)
	{
		return new Adapter\Ftp([
			'host'     => $parameters->host,
			'username' => $parameters->username,
			'password' => $parameters->password,

			'port'    => $parameters->port,
			'root'    => $parameters->root,
			'passive' => $parameters->passive,
			'ssl'     => $parameters->ssl,
			'timeout' => $parameters->timeout,
		]);
	}
}
