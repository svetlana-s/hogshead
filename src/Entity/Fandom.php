<?php

namespace App\Entity;

use App\Repository\FandomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FandomRepository::class)
 * @ORM\Table(name="fandoms")
 */
class Fandom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Fanfic::class, mappedBy="fandom", orphanRemoval=true)
     */
    private ArrayCollection $fanfics;

    /**
     * @ORM\OneToMany(targetEntity=Preference::class, mappedBy="fandom", orphanRemoval=true)
     */
    private ArrayCollection $preferences;

    public function __construct()
    {
        $this->fanfics = new ArrayCollection();
        $this->preferences = new ArrayCollection();
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

    /**
     * @return Collection|Fanfic[]
     */
    public function getFanfics(): Collection
    {
        return $this->fanfics;
    }

    public function addFanfic(Fanfic $fanfic): self
    {
        if (!$this->fanfics->contains($fanfic)) {
            $this->fanfics[] = $fanfic;
            $fanfic->setFandom($this);
        }

        return $this;
    }

    public function removeFanfic(Fanfic $fanfic): self
    {
        if ($this->fanfics->removeElement($fanfic)) {
            // set the owning side to null (unless already changed)
            if ($fanfic->getFandom() === $this) {
                $fanfic->setFandom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Preference[]
     */
    public function getPreferences(): Collection
    {
        return $this->preferences;
    }

    public function addPreference(Preference $preference): self
    {
        if (!$this->preferences->contains($preference)) {
            $this->preferences[] = $preference;
            $preference->setFandom($this);
        }

        return $this;
    }

    public function removePreference(Preference $preference): self
    {
        if ($this->preferences->removeElement($preference)) {
            // set the owning side to null (unless already changed)
            if ($preference->getFandom() === $this) {
                $preference->setFandom(null);
            }
        }

        return $this;
    }
}
