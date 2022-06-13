<?php

namespace App\Builder\Field;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class TextAreaFieldBuilder extends AbstractFieldBuilder
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('rows', IntegerType::class, [
                'property_path' => '[attr][rows]',
                'data' => 3,
            ])
        ;
    }

    public function getFormFQCN()
    {
        return TextareaType::class;
    }

    public function getParent(): string
    {
        return 'text';
    }
}