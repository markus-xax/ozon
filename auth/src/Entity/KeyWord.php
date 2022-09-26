<?php

namespace App\Entity;

use App\Repository\KeyWordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: KeyWordRepository::class)]
class KeyWord
{
    #[ORM\Id]
    #[ORM\Column(type: 'text')]
    private $word;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Ignore]
    private $LastUpdate;

    #[ORM\Column(type: 'integer')]
    private $results;

    #[ORM\Column(type: 'integer')]
    private $frequency;

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    #[Ignore]
    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->LastUpdate;
    }

    public function setLastUpdate(?\DateTimeInterface $LastUpdate): self
    {
        $this->LastUpdate = $LastUpdate;

        return $this;
    }

    public function getResults(): ?int
    {
        return $this->results;
    }

    public function setResults(int $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }
}
