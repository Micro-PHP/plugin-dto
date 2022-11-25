<?php

namespace Micro\Plugin\DTO\Facade;

use Micro\Plugin\DTO\Business\Generator\GeneratorFactoryInterface;

class DTOFacade implements DTOFacadeInterface
{
    /**
     * @param GeneratorFactoryInterface $generatorFactory
     */
    public function __construct(private readonly GeneratorFactoryInterface $generatorFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function generate(): void
    {
        $this->generatorFactory->create()->generate();
    }
}