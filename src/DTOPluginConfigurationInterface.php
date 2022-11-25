<?php

namespace Micro\Plugin\DTO;

interface DTOPluginConfigurationInterface
{
    /**
     * @return string|null
     */
    public function getLoggerName(): ?string;

    /**
     * @return string
     */
    public function getOutputPath(): string;

    /**
     * @return string
     */
    public function getNamespaceGeneral(): string;

    /**
     * @return string
     */
    public function getClassSuffix(): string;

    /**
     * @return iterable<string>
     */
    public function getSchemaPaths(): iterable;

    /**
     * @return string
     */
    public function getSourceFileMask(): string;
}