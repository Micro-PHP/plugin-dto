<?php

namespace Micro\Plugin\DTO\Business\Generator;

use Micro\Library\DTO\GeneratorFacadeInterface;

class Generator implements GeneratorInterface
{
    /**
     * @param GeneratorFacadeInterface $generatorFacade
     */
    public function __construct(private readonly GeneratorFacadeInterface $generatorFacade)
    {}

    /**
     * {@inheritDoc}
     */
    public function generate(): void
    {
        $this->generatorFacade->generate();
    }
}