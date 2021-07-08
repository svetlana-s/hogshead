<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PreferenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PreferenceRepository::class)
 * @ORM\Table(name="preferences")
 */
class Preference
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="preferences")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Fandom::class, inversedBy="preferences")
     * @ORM\JoinColumn(nullable=false)
     */
    private Fandom $fandom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFandom(): ?Fandom
    {
        return $this->fandom;
    }

    public function setFandom(?Fandom $fandom): self
    {
        $this->fandom = $fandom;

        return $this;
    }
}
