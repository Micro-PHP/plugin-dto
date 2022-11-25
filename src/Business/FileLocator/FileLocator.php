<?php

namespace Micro\Plugin\DTO\Business\FileLocator;

use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\DTO\DTOPluginConfigurationInterface;
use Symfony\Component\Finder\Finder;

class FileLocator implements FileLocatorInterface
{
    /**
     * @param DTOPluginConfigurationInterface $DTOPluginConfiguration
     * @param AppKernelInterface $appKernel
     */
    public function __construct(
        private readonly DTOPluginConfigurationInterface $DTOPluginConfiguration,
        private readonly AppKernelInterface $appKernel
    ) {}

    /**
     * {@inheritDoc}
     */
    public function lookup(): iterable
    {
        $finder = $this->createSymfonyFinder();
        $result = [];

        foreach ($finder as $file) {
            $result[] = $file->getRealPath();
        }

        return $result;
    }

    /**
     * @return Finder
     */
    protected function createSymfonyFinder(): Finder
    {
        $finder = new Finder();

        $finder
            ->ignoreVCSIgnored(true)
            ->name($this->DTOPluginConfiguration->getSourceFileMask())
        ;

        foreach ($this->createPathList() as $pluginPath) {
            $finder->in($pluginPath);
        }

        return $finder;
    }

    /**
     * @return iterable
     */
    protected function createPathList(): iterable
    {
        foreach ($this->appKernel->plugins() as $plugin) {
            yield $this->getPluginPathDefinition($plugin);
        }

        foreach ($this->DTOPluginConfiguration->getSchemaPaths() as $path) {
            yield $path;
        }
    }

    /**
     * @param object $plugin
     *
     * @return string
     */
    protected function getPluginPathDefinition(object $plugin): string
    {
        $reflector = new \ReflectionClass($plugin);

        return dirname($reflector->getFileName(), 2);
    }
}