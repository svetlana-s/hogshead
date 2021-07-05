<?php

namespace App\Entity;

use App\Repository\FanficRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FanficRepository::class)
 * @ORM\Table(name="fanfics")
 */
class Fanfic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "The Title field should not be blank."
     * )
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $lastDateUpdate;

    /**
     * @ORM\ManyToOne(targetEntity=Fandom::class, inversedBy="fanfics")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(
     *     message = "The Fandom field should not be blank."
     * )
     */
    private Fandom $fandom;

    /**
     * @ORM\OneToMany(targetEntity=Chapter::class, mappedBy="fanfic", orphanRemoval=true)
     */
    private Collection $chapters;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="fanfic", orphanRemoval=true)
     */
    private Collection $comments;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fanfics")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getFandom(): ?Fandom
    {
        return $this->fandom;
    }

    public function setFandom(?Fandom $fandom): self
    {
        $this->fandom = $fandom;

        return $this;
    }

    /**
     * @return Collection|Chapter[]
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters[] = $chapter;
            $chapter->setFanfic($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getFanfic() === $this) {
                $chapter->setFanfic(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFanfic($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getFanfic() === $this) {
                $comment->setFanfic(null);
            }
        }

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
