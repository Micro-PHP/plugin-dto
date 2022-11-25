<?php

namespace Micro\Plugin\DTO;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Library\DTO\SerializerFacadeDefault;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\DTO\Business\FileLocator\FileLocatorFactory;
use Micro\Plugin\DTO\Business\FileLocator\FileLocatorFactoryInterface;
use Micro\Plugin\DTO\Business\Generator\GeneratorFactory;
use Micro\Plugin\DTO\Business\Generator\GeneratorFactoryInterface;
use Micro\Plugin\DTO\Facade\DTOFacade;
use Micro\Plugin\DTO\Facade\DTOFacadeInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

/**
 * @method DTOPluginConfigurationInterface configuration()
 */
class DTOPlugin extends AbstractPlugin
{
    protected Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;

        $container->register(DTOFacadeInterface::class, function (Container $container) {
            return $this->createDTOGeneratorFacade();
        });

        $container->register(SerializerFacadeInterface::class, function (Container $container) {
            return $this->createDTOSerializerFacade();
        });
    }

    /**
     * @return SerializerFacadeInterface
     */
    protected function createDTOSerializerFacade(): SerializerFacadeInterface
    {
        return new SerializerFacadeDefault();
    }

    /**
     * @return DTOFacadeInterface
     */
    protected function createDTOGeneratorFacade(): DTOFacadeInterface
    {
        return new DTOFacade($this->createGeneratorFactory());
    }

    /**
     * @return GeneratorFactoryInterface
     */
    protected function createGeneratorFactory(): GeneratorFactoryInterface
    {
        return new GeneratorFactory(
            $this->createFileLocatorFactory(),
            $this->configuration(),
            $this->container->get(LoggerFacadeInterface::class)
        );
    }

    /**
     * @return FileLocatorFactoryInterface
     */
    protected function createFileLocatorFactory(): FileLocatorFactoryInterface
    {
        return new FileLocatorFactory(
            appKernel: $this->container->get(AppKernelInterface::class),
            DTOPluginConfiguration: $this->configuration()
        );
    }
}