<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * @ORM\OneToMany(targetEntity=Agent::class, mappedBy="country", cascade="persist")
     */
    private $agents;

    /**
     * @ORM\OneToMany(targetEntity=Target::class, mappedBy="country")
     */
    private $targets;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="country")
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Stash::class, mappedBy="country")
     */
    private $stashes;

    /**
     * @ORM\OneToMany(targetEntity=Missions::class, mappedBy="country")
     */
    private $missions;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->stashes = new ArrayCollection();
        $this->missions = new ArrayCollection();
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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setCountry($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getCountry() === $this) {
                $agent->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
            $target->setCountry($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getCountry() === $this) {
                $target->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCountry($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCountry() === $this) {
                $contact->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stash[]
     */
    public function getStashes(): Collection
    {
        return $this->stashes;
    }

    public function addStash(Stash $stash): self
    {
        if (!$this->stashes->contains($stash)) {
            $this->stashes[] = $stash;
            $stash->setCountry($this);
        }

        return $this;
    }

    public function removeStash(Stash $stash): self
    {
        if ($this->stashes->removeElement($stash)) {
            // set the owning side to null (unless already changed)
            if ($stash->getCountry() === $this) {
                $stash->setCountry(null);
            }
        }

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
            $mission->setCountry($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getCountry() === $this) {
                $mission->setCountry(null);
            }
        }

        return $this;
    }
}
