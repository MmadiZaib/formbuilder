<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface FormInterface extends ResourceInterface
{
    public function getId();

    public function getName();

    public function setName(string $name);

    public function getLegend();

    public function setLegend(string $legend);

    /**
     * @return FormElementInterface[]|ArrayCollection
     */
    public function getFormElements();

    public function setFormElements(ArrayCollection $elements);

    public function addFormElement(FormElementInterface $element);

    public function removeFormElement(FormElementInterface $element);

    public function getUpdatedAt(): \DateTime;
}