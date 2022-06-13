<?php

namespace App\Builder\Field;

use App\Builder\FormBuilderResultInterface;
use App\Entity\FormElementInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ChoiceFieldBuilder extends AbstractFieldBuilder
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
        $choices = $builder
            ->create('choices', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 10,
                ],
                'help_block' => 'Separate choices by line.',
            ])
            ->addModelTransformer(new CallbackTransformer(
                function ($originalChoices) {
                    if ($originalChoices === null) {
                        return '';
                    }

                    return implode("\n", $originalChoices);
                },
                function ($submittedChoices) {
                    return array_map('trim', explode("\n", $submittedChoices));
                }
            ))
        ;

        $builder
            ->add($choices)
            ->add('expanded', CheckboxType::class, [
                'required' => false,
                'help_block' => 'Using "expanded" will use checkboxes or radio button depending on value "multiple"',
            ])
            ->add('multiple', CheckboxType::class, [
                'required' => false,
                'help_block' => 'Allow multiple choices to be chosen.',
            ])
        ;
    }

    public function processResult(FormBuilderResultInterface $result, FormElementInterface $formElement, $value)
    {
        $choices = $formElement->getOption('choices');
        $selectedKeys = (array)$value;
        $selected = [];

        foreach ($selectedKeys as $selectedId) {
            $selected[$selectedId] = $choices[$selectedId];
        }

        return $selected;
    }

    public function getFormFQCN()
    {
        return ChoiceType::class;
    }
}