<?php

namespace App\Entity;

use App\Enums\Validation;
use App\Enums\Validation as ValidationMessages;
use App\Repository\MicroPostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MicroPostRepository::class)]
class MicroPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: Validation::CANNOT_BE_BLANK->value)]
    #[Assert\Length(min: 5, max: 255, minMessage: ValidationMessages::MIN_LENGTH_5->value, maxMessage: ValidationMessages::MAX_LENGTH_5->value)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: ValidationMessages::CANNOT_BE_BLANK->value)]
    #[Assert\Length(min: 5, max: 500, minMessage: ValidationMessages::MIN_LENGTH_5->value, maxMessage: ValidationMessages::MAX_LENGTH_5->value)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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
}
