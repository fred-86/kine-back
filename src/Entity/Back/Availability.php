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
     * @ORM\ManyToOne(targetEntity="Pratictioner", inversedBy="availabilities")
     * @ORM\JoinColumn(name="pratictioner_id", referencedColumnName="id")
     */
    private $pratictioner;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $backgroundColor;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $textColor;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $borderColor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $allDay;

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

    public function getPratictioner(): ?Pratictioner
    {
        return $this->pratictioner;
    }

    public function setPratictioner(?Pratictioner $pratictioner): self
    {
        $this->pratictioner = $pratictioner;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->borderColor;
    }

    public function setBorderColor(?string $borderColor): self
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    public function isAllDay(): ?bool
    {
        return $this->allDay;
    }

    public function setAllDay(?bool $allDay): self
    {
        $this->allDay = $allDay;

        return $this;
    }
}
