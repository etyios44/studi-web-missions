<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM; 

/**
 * @ORM\Entity(repositoryClass=MissionsRepository::class)
 */
class Missions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $TitleMission;

    /**
     * @ORM\Column(type="text")
     */
    private $DescriptionMission;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $NameCode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateStartMission;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateEndMission;

    /**
     * @ORM\ManyToMany(targetEntity=Status::class, inversedBy="missions", cascade={"persist"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="missions", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity=Agent::class, cascade={"persist"})
     */
    private $agent;



    public function __construct()
    {
        $this->status = new ArrayCollection();
        $this->agent = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleMission(): ?string
    {
        return $this->TitleMission;
    }

    public function setTitleMission(string $TitleMission): self
    {
        $this->TitleMission = $TitleMission;

        return $this;
    }

    public function getDescriptionMission(): ?string
    {
        return $this->DescriptionMission;
    }

    public function setDescriptionMission(string $DescriptionMission): self
    {
        $this->DescriptionMission = $DescriptionMission;

        return $this;
    }

    public function getNameCode(): ?string
    {
        return $this->NameCode;
    }

    public function setNameCode(string $NameCode): self
    {
        $this->NameCode = $NameCode;

        return $this;
    }


    public function getDateStartMission(): ?\DateTimeInterface
    {
        return $this->DateStartMission;
    }

    public function setDateStartMission(\DateTimeInterface $DateStartMission): self
    {
        $this->DateStartMission = $DateStartMission;

        return $this;
    }

    public function getDateEndMission(): ?\DateTimeInterface
    {
        return $this->DateEndMission;
    }

    public function setDateEndMission(\DateTimeInterface $DateEndMission): self
    {
        $this->DateEndMission = $DateEndMission;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    public function addStatus(Status $status): self
    {
        if (!$this->status->contains($status)) {
            $this->status[] = $status;
        }

        return $this;
    }

    public function removeStatus(Status $status): self
    {
        $this->status->removeElement($status);

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agent->removeElement($agent);

        return $this;
    }



}
