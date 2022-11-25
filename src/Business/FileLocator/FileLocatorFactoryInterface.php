<?php

namespace Micro\Plugin\DTO\Business\FileLocator;

interface FileLocatorFactoryInterface
{
    /**
     * @return FileLocatorInterface
     */
    public function create(): FileLocatorInterface;
}