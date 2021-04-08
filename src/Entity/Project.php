<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     *  @Assert\NotBlank()
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     *  @Assert\NotBlank()
     */
    private $started_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $ended_at;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="project_id")
     */
    private $title;

    public function __construct()
    {
        $this->title = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->started_at;
    }

    public function setStartedAt(\DateTimeInterface $started_at): self
    {
        $this->started_at = $started_at;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->ended_at;
    }

    public function setEndedAt(?\DateTimeInterface $ended_at): self
    {
        $this->ended_at = $ended_at;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTitle(): Collection
    {
        return $this->title;
    }

    public function addTitle(Task $title): self
    {
        if (!$this->title->contains($title)) {
            $this->title[] = $title;
            $title->setProjectId($this);
        }

        return $this;
    }

    public function removeTitle(Task $title): self
    {
        if ($this->title->removeElement($title)) {
            // set the owning side to null (unless already changed)
            if ($title->getProjectId() === $this) {
                $title->setProjectId(null);
            }
        }

        return $this;
    }
}
