<?php

namespace App\Entity;

use App\Repository\SuperZeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperZeroRepository::class)]
class SuperZero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $superZeroName = null;

    #[ORM\Column(length: 100)]
    private ?string $realName = null;

    #[ORM\Column(length: 255)]
    private ?string $superSkillName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $superSkillDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $weakness = null;

    #[ORM\Column]
    private ?int $power = null;

    #[ORM\ManyToMany(targetEntity: Mission::class, inversedBy: 'superZeros')]
    private Collection $missions;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'superZeros')]
    private Collection $teams;

    #[ORM\ManyToOne(inversedBy: 'superZeros')]
    private ?Gadget $gadget = null;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuperZeroName(): ?string
    {
        return $this->superZeroName;
    }

    public function setSuperZeroName(string $superZeroName): static
    {
        $this->superZeroName = $superZeroName;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): static
    {
        $this->realName = $realName;

        return $this;
    }

    public function getSuperSkillName(): ?string
    {
        return $this->superSkillName;
    }

    public function setSuperSkillName(string $superSkillName): static
    {
        $this->superSkillName = $superSkillName;

        return $this;
    }

    public function getSuperSkillDescription(): ?string
    {
        return $this->superSkillDescription;
    }

    public function setSuperSkillDescription(string $superSkillDescription): static
    {
        $this->superSkillDescription = $superSkillDescription;

        return $this;
    }

    public function getWeakness(): ?string
    {
        return $this->weakness;
    }

    public function setWeakness(string $weakness): static
    {
        $this->weakness = $weakness;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
        }

        return $this;
    }

    public function removeMission(Mission $mission): static
    {
        $this->missions->removeElement($mission);

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        $this->teams->removeElement($team);

        return $this;
    }

    public function getGadget(): ?Gadget
    {
        return $this->gadget;
    }

    public function setGadget(?Gadget $gadget): static
    {
        $this->gadget = $gadget;

        return $this;
    }
}
