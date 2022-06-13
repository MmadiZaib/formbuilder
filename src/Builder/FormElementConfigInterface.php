<?php

namespace App\Builder;

use App\Entity\FormElementInterface;
use Symfony\Component\Validator\Constraint;

interface FormElementConfigInterface
{
    /**
     * @return FormElementInterface
     */
    public function getFormElement();

    public function getType();

    public function setType($type);

    public function setFormFQCN($formFQCN);

    public function getName();

    public function setName(string $name);

    public function getConstraints();

    public function addConstraint(Constraint $constraint);

}