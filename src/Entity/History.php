<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $firstIn = null;

    #[ORM\Column]
    private ?int $secondIn = null;

    #[ORM\Column]
    private ?int $firstOut = null;

    #[ORM\Column]
    private ?int $secondOut = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIn(): ?int
    {
        return $this->firstIn;
    }

    public function setFirstIn(int $firstIn): self
    {
        $this->firstIn = $firstIn;

        return $this;
    }

    public function getSecondIn(): ?int
    {
        return $this->secondIn;
    }

    public function setSecondIn(int $secondIn): self
    {
        $this->secondIn = $secondIn;

        return $this;
    }

    public function getFirstOut(): ?int
    {
        return $this->firstOut;
    }

    public function setFirstOut(int $firstOut): self
    {
        $this->firstOut = $firstOut;

        return $this;
    }

    public function getSecondOut(): ?int
    {
        return $this->secondOut;
    }

    public function setSecondOut(int $secondOut): self
    {
        $this->secondOut = $secondOut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
