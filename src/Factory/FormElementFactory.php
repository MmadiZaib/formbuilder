<?php

namespace App\Factory;

use App\Entity\FormElementInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class FormElementFactory implements FormElementFactoryInterface
{
    private $defaultFactory;
    private $formBuilderRepository;

    public function __construct(FactoryInterface $defaultFactory, RepositoryInterface $formBuilderRepository)
    {
        $this->defaultFactory = $defaultFactory;
        $this->formBuilderRepository = $formBuilderRepository;
    }

    public function createNew()
    {
        return $this->defaultFactory->createNew();
    }

    public function createWithBuilder(string $type, int $formBuilderId): FormElementInterface
    {
        /** @var FormElementInterface $formElement */
        $formElement = $this->createNew();
        $formBuilder = $this->formBuilderRepository->find($formBuilderId);
        $formElement->setForm($formBuilder);
        $formElement->setType($type);

        return $formElement;
    }
}