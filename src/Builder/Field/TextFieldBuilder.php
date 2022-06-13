<?php

namespace App\Builder\Field;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TextFieldBuilder extends AbstractFieldBuilder
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('placeholder', TextType::class, [
                'required' => false,
                'property_path' => '[attr][placeholder]',
            ]);
    }

    public function getFormFQCN()
    {
        return TextType::class;
    }
}