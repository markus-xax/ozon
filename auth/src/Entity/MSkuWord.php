<?php

namespace App\Entity;

use App\Repository\MSkuWordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: MSkuWordRepository::class)]
class MSkuWord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: KeyWord::class, fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "word")]
    private $word;

    #[ORM\ManyToOne(targetEntity: MonitoringSku::class, inversedBy: 'mSkuWords')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private $monitoringSku;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?KeyWord
    {
        return $this->word;
    }

    public function setWord(?KeyWord $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getMonitoringSku(): ?MonitoringSku
    {
        return $this->monitoringSku;
    }

    public function setMonitoringSku(?MonitoringSku $monitoringSku): self
    {
        $this->monitoringSku = $monitoringSku;

        return $this;
    }
}
