<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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
