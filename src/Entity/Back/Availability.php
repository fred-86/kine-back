<?php

namespace App\Entity\Back;

use App\Entity\Back\User;
use App\Repository\AvailabilityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailabilityRepository::class)
 */
class Availability
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(type="boolean",options={"default":1})
     */
    private $recurrence;

    /**
     * @ORM\Column(type="array")
     */
    private $recurrenceDays = [];

    /**
     * @ORM\Column(type="boolean",options={"default":1})
     */
    private $isWorkingHours;

    /**
     * @ORM\Column(type="array")
     */
    private $daysOfWeeks = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="availabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function isRecurrence(): ?bool
    {
        return $this->recurrence;
    }

    public function setRecurrence(bool $recurrence): self
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    public function getRecurrenceDays(): ?array
    {
        return $this->recurrenceDays;
    }

    public function setRecurrenceDays(array $recurrenceDays): self
    {
        $this->recurrenceDays = $recurrenceDays;

        return $this;
    }

    public function isIsWorkingHours(): ?bool
    {
        return $this->isWorkingHours;
    }

    public function setIsWorkingHours(bool $isWorkingHours): self
    {
        $this->isWorkingHours = $isWorkingHours;

        return $this;
    }

    public function getDaysOfWeeks(): ?array
    {
        return $this->daysOfWeeks;
    }

    public function setDaysOfWeeks(array $daysOfWeeks): self
    {
        $this->daysOfWeeks = $daysOfWeeks;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
