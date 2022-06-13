<?php

namespace App\Builder;

use App\Entity\FormInterface;
use Symfony\Component\Form\FormInterface as SymfonyFormInterface;

class FormBuilderResult implements FormBuilderResultInterface
{
    protected $model;
    protected $form;
    protected $pairs;
    protected $replyTo = [];

    public function __construct(FormInterface $model, SymfonyFormInterface $form)
    {
        $this->model = $model;
        $this->form = $form;
    }

    public function addReplyTo($replyTo)
    {
        $this->replyTo[] = $replyTo;
    }

    public function getReplyTo()
    {
        return $this->replyTo;
    }

    public function getData()
    {
        return $this->form->getData();
    }

    public function addPair($label, $value)
    {
        $this->pairs[] = [
            'label' => $label,
            'value' => $value
        ];
    }

    public function getPairs()
    {
        return $this->pairs;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getForm()
    {
        return $this->form;
    }
}