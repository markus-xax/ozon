<?php

namespace App\Entity;

use App\Entity\WbDataEntity\WbData;
use App\Helper\Status\ApiTokenStatus;
use App\Helper\Status\StatusTrait;
use App\Repository\ApiTokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: ApiTokenRepository::class)]
class ApiToken
{
    use StatusTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $token;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'apiToken')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private $apiUser;

    #[ORM\ManyToOne(targetEntity: WbData::class, cascade: ['persist'], inversedBy: 'apiToken')]
    private $wbData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbIncomeData::class)]
    private $wbIncomeData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbStockData::class)]
    private $wbStockData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbSalesData::class)]
    private $wbSalesData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbReportData::class)]
    private $wbReportData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbExciseData::class)]
    private $wbExciseData;

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: WbOrderData::class)]
    private $wbOrdersData;


    public function __construct()
    {
        $this->status = ApiTokenStatus::ACTIVE;
        $this->wbIncomeData = new ArrayCollection();
        $this->wbStockData = new ArrayCollection();
        $this->wbSalesData = new ArrayCollection();
        $this->wbReportData = new ArrayCollection();
        $this->wbExciseData = new ArrayCollection();
        $this->wbOrderData = new ArrayCollection();
        $this->wbOrdersData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getApiUser(): ?User
    {
        return $this->apiUser;
    }

    public function setApiUser(?User $apiUser): self
    {
        $this->apiUser = $apiUser;

        return $this;
    }

    public function getWbData(): ?WbData
    {
        return $this->wbData;
    }

    public function setWbData(?WbData $wbData): self
    {
        $this->wbData = $wbData;

        return $this;
    }

    /**
     * @return Collection<int, WbIncomeData>
     */
    public function getWbIncomeData(): Collection
    {
        return $this->wbIncomeData;
    }

    public function addWbIncomeData(WbIncomeData $wbIncomeData): self
    {
        if (!$this->wbIncomeData->contains($wbIncomeData)) {
            $this->wbIncomeData[] = $wbIncomeData;
            $wbIncomeData->setToken($this);
        }

        return $this;
    }

    public function removeWbIncomeData(WbIncomeData $wbIncomeData): self
    {
        if ($this->wbIncomeData->removeElement($wbIncomeData)) {
            // set the owning side to null (unless already changed)
            if ($wbIncomeData->getToken() === $this) {
                $wbIncomeData->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WbStockData>
     */
    public function getWbStockData(): Collection
    {
        return $this->wbStockData;
    }

    public function addWbStockData(WbStockData $wbStockData): self
    {
        if (!$this->wbStockData->contains($wbStockData)) {
            $this->wbStockData[] = $wbStockData;
            $wbStockData->setToken($this);
        }

        return $this;
    }

    public function removeWbStockData(WbStockData $wbStockData): self
    {
        if ($this->wbStockData->removeElement($wbStockData)) {
            // set the owning side to null (unless already changed)
            if ($wbStockData->getToken() === $this) {
                $wbStockData->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WbSalesData>
     */
    public function getWbSalesData(): Collection
    {
        return $this->wbSalesData;
    }

    public function addWbSalesData(WbSalesData $wbSalesData): self
    {
        if (!$this->wbSalesData->contains($wbSalesData)) {
            $this->wbSalesData[] = $wbSalesData;
            $wbSalesData->setToken($this);
        }

        return $this;
    }

    public function removeWbSalesData(WbSalesData $wbSalesData): self
    {
        if ($this->wbSalesData->removeElement($wbSalesData)) {
            // set the owning side to null (unless already changed)
            if ($wbSalesData->getToken() === $this) {
                $wbSalesData->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WbReportData>
     */
    public function getWbReportData(): Collection
    {
        return $this->wbReportData;
    }

    public function addWbReportData(WbReportData $wbReportData): self
    {
        if (!$this->wbReportData->contains($wbReportData)) {
            $this->wbReportData[] = $wbReportData;
            $wbReportData->setToken($this);
        }

        return $this;
    }

    public function removeWbReportData(WbReportData $wbReportData): self
    {
        if ($this->wbReportData->removeElement($wbReportData)) {
            // set the owning side to null (unless already changed)
            if ($wbReportData->getToken() === $this) {
                $wbReportData->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WbExciseData>
     */
    public function getWbExciseData(): Collection
    {
        return $this->wbExciseData;
    }

    public function addWbExciseData(WbExciseData $wbExciseData): self
    {
        if (!$this->wbExciseData->contains($wbExciseData)) {
            $this->wbExciseData[] = $wbExciseData;
            $wbExciseData->setToken($this);
        }

        return $this;
    }

    public function removeWbExciseData(WbExciseData $wbExciseData): self
    {
        if ($this->wbExciseData->removeElement($wbExciseData)) {
            // set the owning side to null (unless already changed)
            if ($wbExciseData->getToken() === $this) {
                $wbExciseData->setToken(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WbOrderData>
     */
    public function getWbOrdersData(): Collection
    {
        return $this->wbOrdersData;
    }

    public function addWbOrdersData(WbOrderData $wbOrdersData): self
    {
        if (!$this->wbOrdersData->contains($wbOrdersData)) {
            $this->wbOrdersData[] = $wbOrdersData;
            $wbOrdersData->setToken($this);
        }

        return $this;
    }

    public function removeWbOrdersData(WbOrderData $wbOrdersData): self
    {
        if ($this->wbOrdersData->removeElement($wbOrdersData)) {
            // set the owning side to null (unless already changed)
            if ($wbOrdersData->getToken() === $this) {
                $wbOrdersData->setToken(null);
            }
        }

        return $this;
    }

}
