<?php
/**
 * FlysystemExtension.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:Flysystem!
 * @subpackage     DI
 * @since          1.0.0
 *
 * @date           05.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\DI;

use Nette;
use Nette\DI;
use Nette\Utils;
use Nette\PhpGenerator as Code;

use League\Flysystem;

use IPub\Flysystem\Exceptions;
use IPub\Flysystem\Factories;
use IPub\Flysystem\Loaders;

/**
 * Flysystem extension container
 *
 * @package        iPublikuj:Flysystem!
 * @subpackage     DI
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class FlysystemExtension extends DI\CompilerExtension
{
	/**
	 * @var array
	 */
	private $defaults = [
		'adapters'    => [],
		'cache'       => [],
		'filesystems' => [],
	];

	public function loadConfiguration() : void
	{
		/** @var DI\ContainerBuilder $builder */
		$builder = $this->getContainerBuilder();
		// Get extension configuration
		$configuration = $this->getConfig($this->defaults);

		// Load all configured adapters
		$this->loadServices($configuration['adapters'], 'adapters');

		// Load all configured cache systems
		$this->loadServices($configuration['cache'], 'cache');

		$mountManager = $builder->addDefinition($this->prefix('mountmanager'))
			->setType(Flysystem\MountManager::class);

		foreach ($configuration['filesystems'] as $name => $filesystem) {
			// Check if filesystem is with cache
			if (array_key_exists('cache', $filesystem)) {
				// Create adapter name
				$adapterName = 'cached_' . $filesystem['adapter'] . '_' . $filesystem['cache'] . '_' . uniqid();

				// Create cached adapter
				$this->registerService(
					'adapters',
					$adapterName,
					Flysystem\Cached\CachedAdapter::class,
					'IPub\Flysystem\Factories\Adapters\CachedFactory::create',
					[
						'adapterServiceName' => $this->prefix('adapters.' . $filesystem['adapter']),
						'cacheServiceName'   => $this->prefix('cache.' . $filesystem['cache']),
					]
				);

			} else {
				$adapterName = $filesystem['adapter'];
			}

			$builder->addDefinition($this->prefix('filesystem.' . $name))
				->setType(Flysystem\Filesystem::class)
				->setArguments(['adapter' => '@' . $this->prefix('adapters.' . $adapterName)])
				->addTag('ipub.flysystem.filesystem');

			$mountManager->addSetup('?->mountFilesystem(?, ?)', [$mountManager, $name, '@' . $this->prefix('filesystem.' . $name)]);
		}
	}

	/**
	 * @param array $services
	 * @param string $type
	 *
	 * @return void
	 */
	private function loadServices(array $services, string $type) : void
	{
		// Get neon file adapter
		$neonAdapter = new Loaders\NeonFileLoader;

		// Load adapters factories list
		$definitions = $neonAdapter->load(__DIR__ . DIRECTORY_SEPARATOR . $type . '.neon');

		foreach ($services as $serviceName => $configuration) {
			if (isset($configuration['type']) && array_key_exists($configuration['type'], $definitions)) {
				$service = $definitions[$configuration['type']];
				$serviceConfiguration = $this->validateParameters($service['parameters'], $configuration, $serviceName);

				$this->registerService($type, $serviceName, $service['class'], $service['factory'], [
					'parameters' => $serviceConfiguration,
				]);

			} else {
				throw new Exceptions\InvalidAdapterException(sprintf('The service "%s" is not defined in Flysystem configuration.', $serviceName));
			}
		}
	}

	/**
	 * @param string $type
	 * @param string $name
	 * @param string $class
	 * @param string $factory
	 * @param array $arguments
	 *
	 * @return void
	 */
	private function registerService(string $type, string $name, string $class, string $factory, array $arguments = []) : void
	{
		// Check if service class exists
		if (!class_exists($class)) {
			throw new Exceptions\InvalidArgumentException(sprintf('Class "%s" for service "%s" of "%s" does not exists.', $class, $name, $type));
		}

		/** @var DI\ContainerBuilder $builder */
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix($type . '.' . $name))
			->setType($class)
			->setFactory($factory)
			->setArguments($arguments)
			->addTag('ipub.flysystem.' . $type);
	}

	/**
	 * @param array|NULL $parameters
	 * @param array $configuration
	 * @param string $serviceName
	 *
	 * @return Utils\ArrayHash
	 *
	 * @throws Exceptions\InvalidParameterException
	 * @throws Exceptions\InvalidAdapterException
	 * @throws Utils\AssertionException
	 */
	private function validateParameters(?array $parameters, array $configuration, string $serviceName) : Utils\ArrayHash
	{
		$collection = [];

		if ($parameters === NULL) {
			return Utils\ArrayHash::from([]);
		}

		foreach ($parameters as $name => $definition) {
			if (!array_key_exists($name, $configuration) && $definition['required']) {
				throw new Exceptions\InvalidParameterException(sprintf('The parameter "%s" for "%s" is required.', $name, $serviceName));
			}

			if (array_key_exists('default', $definition)) {
				$collection[$name] = $definition['default'];
			}

			if (array_key_exists($name, $configuration)) {
				Utils\Validators::assert($configuration[$name], $definition['type'], $name);

				if (isset($definition['values']) && !in_array($configuration[$name], $definition['values'])) {
					throw new Exceptions\InvalidParameterException(sprintf('The parameter "%s" for "%s" is not in allowed range [%s].', $name, $serviceName, implode(', ', $definition['values'])));
				}

				$collection[$name] = $configuration[$name];
			}
		}

		$collection['extensionPrefix'] = $this->name;

		return Utils\ArrayHash::from($collection);
	}

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 *
	 * @return void
	 */
	public static function register(Nette\Configurator $config, string $extensionName = 'flysystem') : void
	{
		$config->onCompile[] = function (Nette\Configurator $config, Nette\DI\Compiler $compiler) use ($extensionName) {
			$compiler->addExtension($extensionName, new FlysystemExtension);
		};
	}
}
