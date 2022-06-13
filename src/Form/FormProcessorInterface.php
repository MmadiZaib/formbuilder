<?php

namespace App\Form;

use App\Entity\FormInterface;
use Symfony\Component\Form\FormInterface as SymfonyFormInterface;

interface FormProcessorInterface
{
    public function process(FormInterface $model, SymfonyFormInterface $form);
}