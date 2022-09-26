<?php

namespace App\Entity;

use App\Repository\TokenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
class Token
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $token;
    #[ORM\Column(type: 'integer')]
    private $currentcount;
    #[ORM\Column(type: 'integer')]
    private $maxcount;
    #[ORM\Column(type: 'datetime')]
    private $expires;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
    public function getCurrentCount(): ?int
    {
        return $this->currentcount;
    }

    public function setCurrentCount(int $count): self
    {
        $this->currentcount = $count;

        return $this;
    }
    
    public function getMaxCount(): ?int
    {
        return $this->maxcount;
    }

    public function setMaxCount(int $count): self
    {
        $this->maxcount = $count;

        return $this;
    }
    public function getExpires(): \DateTimeInterface
    {
        return $this->expires;
    }

    public function setExpires(\DateTimeInterface $exp): self
    {
        $this->expires = $exp;

        return $this;
    }
}
