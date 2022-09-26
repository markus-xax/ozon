<?php

namespace App\Entity;

use App\Repository\MonitoringSkuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;
#[ORM\Entity(repositoryClass: MonitoringSkuRepository::class)]
   
class MonitoringSku
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'bigint')]
    #[SerializedName("sku")]
    private $sku;

    #[ORM\ManyToOne(targetEntity: MonitoringProject::class, inversedBy: 'monitoringSkus')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private $project;

    #[ORM\OneToMany(mappedBy: 'monitoringSku', targetEntity: MSkuWord::class)]
    #[SerializedName("words")]
    private $mSkuWords;

    public function __construct()
    {
        $this->mSkuWords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[SerializedName("sku")]
    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $Sku): self
    {
        $this->sku = $Sku;

        return $this;
    }

    public function getProject(): ?MonitoringProject
    {
        return $this->project;
    }

    public function setProject(?MonitoringProject $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, MSkuWord>
     */
    #[SerializedName("words")]
    public function getMSkuWords(): Collection
    {
        return $this->mSkuWords;
    }

    public function addMSkuWord(MSkuWord $mSkuWord): self
    {
        if (!$this->mSkuWords->contains($mSkuWord)) {
            $this->mSkuWords[] = $mSkuWord;
            $mSkuWord->setMonitoringSku($this);
        }

        return $this;
    }

    public function removeMSkuWord(MSkuWord $mSkuWord): self
    {
        if ($this->mSkuWords->removeElement($mSkuWord)) {
            // set the owning side to null (unless already changed)
            if ($mSkuWord->getMonitoringSku() === $this) {
                $mSkuWord->setMonitoringSku(null);
            }
        }

        return $this;
    }
    
}
