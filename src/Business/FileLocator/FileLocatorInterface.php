<?php

namespace Micro\Plugin\DTO\Business\FileLocator;

interface FileLocatorInterface
{
    /**
     * @return iterable<string>
     */
    public function lookup(): iterable;
}