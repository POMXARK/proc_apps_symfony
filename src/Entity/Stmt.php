<?php

namespace App\Entity;

use App\Repository\StmtRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Заявка.
 */
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: StmtRepository::class)]
class Stmt
{
    /**
     * Заявка не рассмотрена.
     */
    public const STATUS_ACTIVE = 'Active';

    /**
     * Заявка рассмотрена.
     */
    public const STATUS_RESOLVED = 'Resolved';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, options: ['comment' => 'Имя пользователя.'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, options: ['comment' => 'Email пользователя.'])]
    private ?string $email = null;

    #[ORM\Column(type: 'string', nullable: true, options: ['comment' => 'Статус.'])]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT, options: ['comment' => 'Сообщение пользователя.'])]
    private ?string $message = null;

    #[ORM\Column(type: Types::TEXT, nullable: true, options: ['comment' => 'Ответ ответственного лица.'])]
    private ?string $comment = null;

    #[ORM\Column(options: ['comment' => 'Время создания заявки.'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(options: ['comment' => 'Время ответа на заявку.'])]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Имя пользователя.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Имя пользователя.
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Email пользователя.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email пользователя.
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Статус.
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Статус.
     */
    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Сообщение пользователя.
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Сообщение пользователя.
     */
    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Ответ ответственного лица.
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Ответ ответственного лица.
     */
    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Время создания заявки.
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * Время создания заявки.
     */
    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->created_at = new \DateTimeImmutable();
    }

    /**
     * Время ответа на заявку.
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    /**
     * Время ответа на заявку.
     */
    #[ORM\PrePersist]
    public function setUpdatedAt(): void
    {
        $this->updated_at = new \DateTimeImmutable();
    }
}
