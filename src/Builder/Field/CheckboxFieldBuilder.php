<?php

namespace App\Builder\Field;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class CheckboxFieldBuilder extends AbstractFieldBuilder
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('data', CheckboxType::class, [
                'label' => 'Default Value',
                'required' => false,
                'property_path' => '[data]',
            ])
        ;
    }

    public function getFormFQCN()
    {
        return CheckboxType::class;
    }
}