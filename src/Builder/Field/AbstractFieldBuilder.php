<?php

namespace App\Builder\Field;

use App\Builder\FormBuilderResultInterface;
use App\Builder\FormElementConfigInterface;
use App\Entity\FormElementInterface;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractFieldBuilder implements FormFieldBuilderInterface
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
    }

    public function processResult(FormBuilderResultInterface $result, FormElementInterface $formElement, $value)
    {
        return $value;
    }

    public function buildFormConfig(FormElementConfigInterface $config)
    {
    }

    public function getFormFQCN()
    {
    }

    public function getParent()
    {
    }
}