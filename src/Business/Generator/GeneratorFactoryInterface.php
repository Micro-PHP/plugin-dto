<?php

namespace Micro\Plugin\DTO\Business\Generator;

interface GeneratorFactoryInterface
{
    /**
     * @return GeneratorInterface
     */
    public function create(): GeneratorInterface;
}