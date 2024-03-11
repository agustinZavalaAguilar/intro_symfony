<?php

namespace App\Entity;

use App\Repository\GadgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GadgetRepository::class)]
class Gadget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $intensity = null;

    #[ORM\OneToMany(targetEntity: SuperZero::class, mappedBy: 'gadget')]
    private Collection $superZeros;

    public function __construct()
    {
        $this->superZeros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIntensity(): ?int
    {
        return $this->intensity;
    }

    public function setIntensity(int $intensity): static
    {
        $this->intensity = $intensity;

        return $this;
    }

    /**
     * @return Collection<int, SuperZero>
     */
    public function getSuperZeros(): Collection
    {
        return $this->superZeros;
    }

    public function addSuperZero(SuperZero $superZero): static
    {
        if (!$this->superZeros->contains($superZero)) {
            $this->superZeros->add($superZero);
            $superZero->setGadget($this);
        }

        return $this;
    }

    public function removeSuperZero(SuperZero $superZero): static
    {
        if ($this->superZeros->removeElement($superZero)) {
            // set the owning side to null (unless already changed)
            if ($superZero->getGadget() === $this) {
                $superZero->setGadget(null);
            }
        }

        return $this;
    }
}
