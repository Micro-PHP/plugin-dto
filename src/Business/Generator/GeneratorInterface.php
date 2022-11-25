<?php

namespace Micro\Plugin\DTO\Business\Generator;

interface GeneratorInterface
{
    /**
     * @return void
     */
    public function generate(): void;
}