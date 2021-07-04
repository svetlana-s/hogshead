<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ChapterRepository::class)
 * @ORM\Table(name="chapters")
 */
class Chapter
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
     *     message = "The Name field should not be blank."
     * )
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message = "The Number field should not be blank."
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="The Number field should be an integer."
     * )
     */
    private int $number;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message = "The Content field should not be blank."
     * )
     */
    private string $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $image;

    /**
     * @ORM\ManyToOne(targetEntity=Fanfic::class, inversedBy="chapters")
     * @ORM\JoinColumn(nullable=false)
     */
    private Fanfic $fanfic;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastDateUpdate;

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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getLastDateUpdate(): ?\DateTimeInterface
    {
        return $this->lastDateUpdate;
    }

    public function setLastDateUpdate(\DateTimeInterface $lastDateUpdate): self
    {
        $this->lastDateUpdate = $lastDateUpdate;

        return $this;
    }
}
