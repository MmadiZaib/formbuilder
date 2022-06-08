<?php

namespace App\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface FormElementInterface extends ResourceInterface
{
    public function getId();

    public function getType(): string;

    public function getName(): string;

    public function setName(string $name);

    public function setType(string $type);

    public function getForm();

    public function setForm(FormInterface $form);

    public function getPosition();

    public function setPosition(int $position);

    public function getOptions();

    public function setOptions(array $options);

    public function getExtra($extra, $default = null);

    public function setExtra($extra, $value);

    public function getOption($option);
}