<?php

namespace App\Builder;

use App\Builder\Field\FormFieldBuilderInterface;
use App\Entity\FormElementInterface;

class FieldBuilderRegistry
{
    private $baseBuilder;
    private $fields;

    public function __construct(FormFieldBuilderInterface $baseBuilder, $fields = [])
    {
        $this->baseBuilder = $baseBuilder;
        $this->fields = $fields;
    }

    public function getFieldBuilder($type): FormFieldBuilderInterface
    {
        return $this->fields[$type];
    }

    public function getFieldBuilders(string $type)
    {
        $fieldBuilder = $this->getFieldBuilder($type);
        $builders = [$fieldBuilder];

        while ($fieldBuilder->getParent() !== null) {
            $fieldBuilder = $this->getFieldBuilder($fieldBuilder->getParent());
            array_unshift($builders, $fieldBuilder);
        }

        // Add Base Builder
        array_unshift($builders, $this->baseBuilder);

        return $builders;
    }

    public function getFormElementConfig(FormElementInterface $element)
    {

        $config = new FormElementConfig($element);
        $typeBuilder = $this->getFieldBuilder($element->getType());

        $config->setFormFQCN($typeBuilder->getFormFQCN());
        $builders = $this->getFieldBuilders($element->getType());


        foreach ($builders as $builder) {
            $builder->buildFormConfig($config);
        }

        return $config;
    }

    public function getTypes()
    {
        return array_keys($this->fields);
    }
}