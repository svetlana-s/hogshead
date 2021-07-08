<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message = "The Content field should not be blank."
     * )
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastDateUpdate;

    /**
     * @ORM\ManyToOne(targetEntity=Fanfic::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(
     *     message = "The Fanfic field should not be blank."
     * )
     */
    private Fanfic $fanfic;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLastDateUpdate(): ?\DateTimeInterface
    {
        return $this->lastDateUpdate;
    }

    public function setLastDateUpdate(\DateTimeInterface $lastDateUpdate): self
    {
        $this->lastDateUpdate = $lastDateUpdate;

        return $this;
    }

    public function getFanfic(): ?Fanfic
    {
        return $this->fanfic;
    }

    public function setFanfic(?Fanfic $fanfic): self
    {
        $this->fanfic = $fanfic;

        return $this;
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
}
