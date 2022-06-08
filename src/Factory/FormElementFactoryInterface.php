<?php

namespace App\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;

interface FormElementFactoryInterface extends FactoryInterface
{
    public function createWithBuilder(string $type, int $formBuilderId);
}