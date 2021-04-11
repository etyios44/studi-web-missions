<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
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
    private $DetailStatus;

    /**
     * @ORM\ManyToMany(targetEntity=Missions::class, mappedBy="status")
     */
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetailStatus(): ?string
    {
        return $this->DetailStatus;
    }

    public function setDetailStatus(string $DetailStatus): self
    {
        $this->DetailStatus = $DetailStatus;

        return $this;
    }

    /**
     * @return Collection|Missions[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->addStatus($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeStatus($this);
        }

        return $this;
    }

    
}
