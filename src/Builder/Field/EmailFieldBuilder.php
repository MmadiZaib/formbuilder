<?php

namespace App\Builder\Field;

use App\Builder\FormBuilderResultInterface;
use App\Builder\FormElementConfigInterface;
use App\Entity\FormElementInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;

class EmailFieldBuilder extends AbstractFieldBuilder
{
    public function buildOptionForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('placeholder', TextType::class, [
                'required' => false,
                'property_path' => '[attr][placeholder]',
            ])
            ->add('replyTo', CheckboxType::class, [
                'required' => false,
                'property_path' => '[extra][replyTo]',
                'help_block' => 'If filled, use as a reply-to to field so notification emails will reply to this address.',
            ])
        ;
    }

    public function processResult(FormBuilderResultInterface $result, FormElementInterface $formElement, $value)
    {
        if ($formElement->getExtra('replyTo', false) && $value !== null) {
            $result->addReplyTo($value);
        }

        return parent::processResult($result, $formElement, $value);
    }

    public function buildFormConfig(FormElementConfigInterface $config): void
    {
        $config->addConstraint(new Email());
    }

    public function getFormFQCN()
    {
        return EmailType::class;
    }

    public function getParent(): string
    {
        return 'text';
    }
}