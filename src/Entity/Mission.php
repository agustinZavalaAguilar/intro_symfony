<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $difficulty = null;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    #[ORM\ManyToMany(targetEntity: SuperZero::class, mappedBy: 'missions')]
    private Collection $superZeros;

    public function __construct()
    {
        $this->superZeros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
            $superZero->addMission($this);
        }

        return $this;
    }

    public function removeSuperZero(SuperZero $superZero): static
    {
        if ($this->superZeros->removeElement($superZero)) {
            $superZero->removeMission($this);
        }

        return $this;
    }
}
