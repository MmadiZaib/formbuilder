<?php

namespace App\Form;

use App\Builder\FieldBuilderRegistry;
use App\Builder\FormBuilderResult;
use App\Entity\FormInterface;
use Symfony\Component\Form\FormInterface as SymfonyFormInterface;

class FormProcessor implements FormProcessorInterface
{
    /** @var FieldBuilderRegistry  */
    private $registry;

    public function __construct(FieldBuilderRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function process(FormInterface $model, SymfonyFormInterface $form)
    {
        $result = new FormBuilderResult($model, $form);
        $data = $form->getData();

        foreach ($model->getFormElements() as $element) {
            $options = $element->getOptions();
            $config = $this->registry->getFormElementConfig($element);
            $label = $options['label'] ?? sprintf('Element %d', $element->getId());
            $value = $data[$config->getName()];

            // Let field modify result if needed
            $field = $this->registry->getFieldBuilder($element->getType());
            $value = $field->processResult($result, $element, $value);

            $result->addPair($label, $value);
        }

        return $result;
    }
}