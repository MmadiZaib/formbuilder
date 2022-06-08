<?php

namespace App\Entity;

use App\Repository\FormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FormRepository::class)
 * @UniqueEntity("name")
 */
class Form implements FormInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $legend;

    /**
     * @ORM\OneToMany(targetEntity=FormElement::class, mappedBy="form", cascade={"persist", "remove"})
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $elements;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * @return Collection<int, FormElement>
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(FormElement $element): self
    {
        if (!$this->elements->contains($element)) {
            $this->elements[] = $element;
            $element->setForm($this);
        }

        return $this;
    }

    public function removeElement(FormElement $element): self
    {
        if ($this->elements->removeElement($element)) {
            // set the owning side to null (unless already changed)
            if ($element->getForm() === $this) {
                $element->setForm(null);
            }
        }

        return $this;
    }

    public function getFormElements()
    {
        return $this->elements;
    }

    public function setFormElements(ArrayCollection $elements)
    {
        $this->elements = $elements;

        return $this;
    }

    public function addFormElement(FormElementInterface $element): self
    {
        $this->setUpdatedAt(new \DateTime());

        $element->setForm($this);

        $this->elements->add($element);

        return $this;
    }

    public function removeFormElement(FormElementInterface $element): self
    {
        $this->setUpdatedAt(new \DateTime());
        $this->elements->remove($element);

        return $this;
    }
}
