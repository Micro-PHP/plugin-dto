<?php

namespace Micro\Plugin\DTO\Business\Generator;

use Micro\Library\DTO\ClassGeneratorFacadeDefault;
use Micro\Library\DTO\GeneratorFacadeInterface;
use Micro\Plugin\DTO\Business\FileLocator\FileLocatorFactoryInterface;
use Micro\Plugin\DTO\DTOPluginConfigurationInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;
use Psr\Log\NullLogger;

class GeneratorFactory implements GeneratorFactoryInterface
{
    /**
     * @param FileLocatorFactoryInterface $fileLocatorFactory
     * @param DTOPluginConfigurationInterface $DTOPluginConfiguration
     * @param LoggerFacadeInterface $loggerFacade
     */
    public function __construct(
        private readonly FileLocatorFactoryInterface $fileLocatorFactory,
        private readonly DTOPluginConfigurationInterface $DTOPluginConfiguration,
        private readonly LoggerFacadeInterface $loggerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): GeneratorInterface
    {
        return new Generator($this->createGeneratorFacade());
    }

    /**
     * @return GeneratorFacadeInterface
     */
    protected function createGeneratorFacade(): GeneratorFacadeInterface
    {
        $loggerName = $this->DTOPluginConfiguration->getLoggerName();
        $logger = new NullLogger();

        if($loggerName) {
            $logger = $this->loggerFacade->getLogger($loggerName);
        }

        return new ClassGeneratorFacadeDefault(
            filesSchemeCollection: $this->fileLocatorFactory->create()->lookup(),
            outputPath: $this->DTOPluginConfiguration->getOutputPath(),
            namespaceGeneral: $this->DTOPluginConfiguration->getNamespaceGeneral(),
            classSuffix: $this->DTOPluginConfiguration->getClassSuffix(),
            logger: $logger,
        );
    }
}