<?php
/**
 * Test: IPub\Flysystem\Extension
 * @testCase
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     Tests
 * @since          1.0.0
 *
 * @date           26.04.16
 */

namespace IPubTests\Flysystem;

use Nette;

use Tester;
use Tester\Assert;

use IPub;
use IPub\Flysystem;

use League;

require __DIR__ . '/../bootstrap.php';

/**
 * Registering flysystem extension tests
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Tests
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ExtensionTest extends Tester\TestCase
{
	public function testCompilersServices()
	{
		$dic = $this->createContainer();

		Assert::true($dic->getService('flysystem.mountmanager') instanceof League\Flysystem\MountManager);
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer()
	{
		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		Flysystem\DI\FlysystemExtension::register($config);

		return $config->createContainer();
	}
}

\run(new ExtensionTest());
