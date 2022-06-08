<?php

namespace App\Entity;

use App\Repository\FormElementRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=FormElementRepository::class)
 */
class FormElement implements FormElementInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Gedmo\SortablePosition()
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Form::class, inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $form;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $options = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setForm(FormInterface $form): self
    {
        $this->form = $form;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOption($option)
    {
        return $this->options[$option];
    }

    public function getExtra($extra, $default = null)
    {
        if (isset($this->options['extra']) && isset($this->options['extra'][$extra]))
        {
            return $this->options['extra'][$extra];
        }

        return $default;
    }

    public function setExtra($extra, $value)
    {
        if (!isset($this->options['extra']))
        {
            $this->options['extra'][$extra] = $value;
        }

        return $this;
    }
}
