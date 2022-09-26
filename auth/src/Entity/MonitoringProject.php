<?php

namespace App\Entity;

use App\Repository\MonitoringProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;
#[ORM\Entity(repositoryClass: MonitoringProjectRepository::class)]
class MonitoringProject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'monitoringProjects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore()]
    private $Owner;

    #[ORM\Column(type: 'text')]
    private $Name;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: MonitoringSku::class)]
    private $monitoringSkus;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $skuCount;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $wordCount;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0Total;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0Top1;
    
     #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0Top4;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0Top12;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0Top100;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d0AvgPos;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1Total;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1Top1;
    
     #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1Top4;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1Top12;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1Top100;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1AvgPos;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeTotal;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeTop1;
    
     #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeTop4;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeTop12;
     
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeTop100;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $changeAvgPos;
    
    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $d1FTotal;

     
    public function __construct()
    {
        $this->monitoringSkus = new ArrayCollection();
        $this->skuCount = 0;
        $this->wordCount = 0;
        $this->d0Total = 0;
        $this->d0Top1 = 0;
        $this->d0Top4 = 0;
        $this->d0Top12 = 0;
        $this->d0Top100 = 0;
        $this->d0AvgPos = 0;
        $this->d1Total = 0;
        $this->d1Top1 = 0;
        $this->d1Top4 = 0;
        $this->d1Top12 = 0;
        $this->d1Top100 = 0;
        $this->d1AvgPos = 0;
        $this->changeTotal = 0;
        $this->changeTop1 = 0;
        $this->changeTop4 = 0;
        $this->changeTop12 = 0;
        $this->changeTop100 = 0;
        $this->changeAvgPos = 0;
        $this->d1FTotal = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->Owner;
    }

    public function setOwner(?User $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
    
    public function getSkuCount(): ?int
    {
        return $this->skuCount;
    }

    public function setSkuCount(string $count): self
    {
        $this->skuCount = $count;

        return $this;
    }
    
    public function getWordCount(): ?int
    {
        return $this->wordCount;
    }

    public function setWordCount(string $num): self
    {
        $this->wordCount = $num;

        return $this;
    }
    
    public function getD0Total(): ?int
    {
        return $this->d0Total;
    }

    public function setD0Total(string $num): self
    {
        $this->d0Total = $num;

        return $this;
    }
    
     public function getD0Top1(): ?int
    {
        return $this->d0Top1;
    }

    public function setD0Top1(string $num): self
    {
        $this->d0Top1 = $num;

        return $this;
    }
    public function getD0Top4(): ?int
    {
        return $this->d0Top4;
    }

    public function setD0Top4(string $num): self
    {
        $this->d0Top4 = $num;

        return $this;
    }
    
    public function getD0Top12(): ?int
    {
        return $this->d0Top12;
    }

    public function setD0Top12(string $num): self
    {
        $this->d0Top12 = $num;

        return $this;
    }
    
    public function getD0Top100(): ?int
    {
        return $this->d0Top100;
    }

    public function setD0Top100(string $num): self
    {
        $this->d0Top100 = $num;

        return $this;
    }
    
     public function getD0AvgPos(): ?int
    {
        return $this->d0AvgPos;
    }

    public function setD0AvgPos(string $num): self
    {
        $this->d0AvgPos = $num;

        return $this;
    }
    
    public function getD1Total(): ?int
    {
        return $this->d1Total;
    }

    public function setD1Total(string $num): self
    {
        $this->d1Total = $num;

        return $this;
    }
    
     public function getD1Top1(): ?int
    {
        return $this->d1Top1;
    }

    public function setD1Top1(string $num): self
    {
        $this->d1Top1 = $num;

        return $this;
    }
    public function getD1Top4(): ?int
    {
        return $this->d1Top4;
    }

    public function setD1Top4(string $num): self
    {
        $this->d1Top4 = $num;

        return $this;
    }
    
    public function getD1Top12(): ?int
    {
        return $this->d1Top12;
    }

    public function setD1Top12(string $num): self
    {
        $this->d1Top12 = $num;

        return $this;
    }
    
    public function getD1Top100(): ?int
    {
        return $this->d1Top100;
    }

    public function setD1Top100(string $num): self
    {
        $this->d1Top100 = $num;

        return $this;
    }
    
     public function getD1AvgPos(): ?int
    {
        return $this->d1AvgPos;
    }

    public function setD1AvgPos(string $num): self
    {
        $this->d1AvgPos = $num;

        return $this;
    }
    
    public function getChangeTotal(): ?int
    {
        return $this->changeTotal;
    }

    public function setChangeTotal(string $num): self
    {
        $this->changeTotal = $num;

        return $this;
    }
    
     public function getChangeTop1(): ?int
    {
        return $this->changeTop1;
    }

    public function setChangeTop1(string $num): self
    {
        $this->changeTop1 = $num;

        return $this;
    }
    public function getChangeTop4(): ?int
    {
        return $this->changeTop4;
    }

    public function setChangeTop4(string $num): self
    {
        $this->changeTop4 = $num;

        return $this;
    }
    
    public function getChangeTop12(): ?int
    {
        return $this->changeTop12;
    }

    public function setChangeTop12(string $num): self
    {
        $this->changeTop12 = $num;

        return $this;
    }
    
    public function getChangeTop100(): ?int
    {
        return $this->changeTop100;
    }

    public function setChangeTop100(string $num): self
    {
        $this->changeTop100 = $num;

        return $this;
    }
    
     public function getChangeAvgPos(): ?int
    {
        return $this->changeAvgPos;
    }

    public function setChangeAvgPos(string $num): self
    {
        $this->changeAvgPos = $num;

        return $this;
    }
    
    public function getD1FTotal(): ?int
    {
        return $this->d1FTotal;
    }

    public function setD1FTotal(string $num): self
    {
        $this->d1FTotal = $num;

        return $this;
    }
    
    
    

    /**
     * @return Collection<int, MonitoringSku>
     */
    public function getMonitoringSkus(): Collection
    {
        return $this->monitoringSkus;
    }

    public function addMonitoringSku(MonitoringSku $monitoringSku): self
    {
        if (!$this->monitoringSkus->contains($monitoringSku)) {
            $this->monitoringSkus[] = $monitoringSku;
            $monitoringSku->setProject($this);
        }

        return $this;
    }

    public function removeMonitoringSku(MonitoringSku $monitoringSku): self
    {
        if ($this->monitoringSkus->removeElement($monitoringSku)) {
            // set the owning side to null (unless already changed)
            if ($monitoringSku->getProject() === $this) {
                $monitoringSku->setProject(null);
            }
        }

        return $this;
    }
    
    public function minInfo()
    {
        return [
            "id" => $this->getId(),
            'Name' => $this->getName()
        ];
    }
}
