<?php

namespace App\Event;

use App\Entity\FormInterface;
use Symfony\Contracts\EventDispatcher\Event;

class FormBuilderFactoryEvent extends Event
{
    protected $form;
    protected $options;

    public function __construct(FormInterface $form, array $options = [])
    {
        $this->form = $form;
        $this->options = $options;
    }

    public function getFormBuilder()
    {
        return $this->form;
    }

    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }

    public function mergeOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
