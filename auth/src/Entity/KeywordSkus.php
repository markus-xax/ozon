<?php

namespace App\Entity;

use App\Repository\KeywordSkusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeywordSkusRepository::class)]
class KeywordSkus
{
    #[ORM\Id]
    #[ORM\Column(type: 'text')]
    private $word;
    
    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    private $sku;

    #[ORM\Id]
    #[ORM\Column(type: 'date')]
    private $pdate;

    #[ORM\Column(type: 'integer')]
    private $pos;
    
     #[ORM\Column(type: 'boolean', options: ["default" => true] )]
    private $active;

    
     public function __construct($word, $sku, $pdate)
    {
        $this->pdate = $pdate;
        $this->sku = $sku;
         $this->word = $word;
    }
    
    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getPdate(): ?\DateTimeInterface
    {
        return $this->pdate;
    }

    public function setPdate(\DateTimeInterface $pdate): self
    {
        $this->pdate = $pdate;

        return $this;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function setPos(int $pos): self
    {
        $this->pos = $pos;

        return $this;
    }
    
    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }
}
