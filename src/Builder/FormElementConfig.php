<?php

namespace App\Builder;

use App\Entity\FormElementInterface;
use Symfony\Component\Validator\Constraint;

class FormElementConfig implements FormElementConfigInterface
{
    protected $element;
    protected $type;
    protected $formFQCN;
    protected $name;
    protected $constraints = [];

    public function __construct(FormElementInterface $element)
    {
        $this->element = $element;
    }

    public function getFormElement()
    {
        return $this->element;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFormFQCN()
    {
        return $this->formFQCN;
    }

    public function setFormFQCN($formFQCN): self
    {
        $this->formFQCN = $formFQCN;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;
    }
}