<?php
/**
 * Test: IPub\Flysystem\Filesystem
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

declare(strict_types = 1);

namespace IPubTests\Flysystem;

use Nette;

use Tester;
use Tester\Assert;

use IPub\Flysystem;

use League;

require __DIR__ . '/../bootstrap.php';

/**
 * Filesystem extension tests
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     Tests
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class FilesystemTest extends Tester\TestCase
{
	/**
	 * @var \Nette\DI\Container
	 */
	private $container;

	/**
	 * @var League\Flysystem\MountManager
	 */
	private $mountManager;

	protected function setUp() : void
	{
		parent::setUp();

		$this->container = $this->createContainer();
		$this->mountManager = $this->container->getByType('League\Flysystem\MountManager');
	}

	public function testLoadFilesystems() : void
	{
		Assert::true($this->mountManager->getFilesystem('localFileSystem') instanceof League\Flysystem\FilesystemInterface);
	}

	public function testLocalFilesystem() : void
	{
		Assert::true($this->mountManager->write('localFileSystem://this/is/test.txt', 'Testing text'));
		Assert::same($this->mountManager->read('localFileSystem://this/is/test.txt'), 'Testing text');
		Assert::true($this->mountManager->delete('localFileSystem://this/is/test.txt'));
		Assert::true($this->mountManager->deleteDir('localFileSystem://this'));
	}

	/**
	 * @throws League\Flysystem\FileNotFoundException
	 */
	public function testReadNotExistingFile() : void
	{
		$this->mountManager->read('localFileSystem://this/is/test.txt');
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer() : Nette\DI\Container
	{
		$rootDir = __DIR__ . '/../../';

		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		$config->addParameters(['container' => ['class' => 'SystemContainer_' . md5(time())]]);
		$config->addParameters(['appDir' => $rootDir, 'wwwDir' => $rootDir]);

		$config->addConfig(__DIR__ . '/files/config.neon');

		Flysystem\DI\FlysystemExtension::register($config);

		return $config->createContainer();
	}
}

\run(new FilesystemTest());
