<?php

namespace App\Form;

use App\Entity\FormInterface;
use Symfony\Component\Form\FormInterface as SymfonyFormInterface;

interface FormBuilderFactoryInterface
{
    public function build(FormInterface $form, $data = null): SymfonyFormInterface;
}