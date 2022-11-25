<?php

namespace Micro\Plugin\DTO\Business\FileLocator;

use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\DTO\DTOPluginConfigurationInterface;

class FileLocatorFactory implements FileLocatorFactoryInterface
{
    /**
     * @param AppKernelInterface $appKernel
     * @param DTOPluginConfigurationInterface $DTOPluginConfiguration
     */
    public function __construct(
        private readonly AppKernelInterface $appKernel,
        private readonly DTOPluginConfigurationInterface $DTOPluginConfiguration
    )
    {
    }

    /**
     * @return FileLocatorInterface
     */
    public function create(): FileLocatorInterface
    {
        return new FileLocator(
            DTOPluginConfiguration: $this->DTOPluginConfiguration,
            appKernel: $this->appKernel
        );
    }
}