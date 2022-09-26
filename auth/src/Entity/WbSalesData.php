<?php

namespace App\Entity;

use App\Repository\WbSalesDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbSalesDataRepository::class)]
class WbSalesData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbSalesData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $gNumber;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'datetime')]
    private $lastChangeDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $supplierArticle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $techSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $barcode;

    #[ORM\Column(type: 'float', nullable: true)]
    private $totalPrice;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $discountPercent;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isSupply;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRealization;

    #[ORM\Column(type: 'float', nullable: true)]
    private $promoCodeDiscount;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $warehouseName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $countryName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $oblastOkrugName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $regionName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $incomeID;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $saleID;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $odid;

    #[ORM\Column(type: 'float', nullable: true)]
    private $spp;

    #[ORM\Column(type: 'float', nullable: true)]
    private $forPay;

    #[ORM\Column(type: 'float', nullable: true)]
    private $finishedPrice;

    #[ORM\Column(type: 'float', nullable: true)]
    private $priceWithDisc;

    #[ORM\Column(type: 'integer')]
    private $nmId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[ORM\Column(type: 'boolean')]
    private $isStorno;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sticker;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $srid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?ApiToken
    {
        return $this->token;
    }

    public function setToken(?ApiToken $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getGNumber(): ?string
    {
        return $this->gNumber;
    }

    public function setGNumber(?string $gNumber): self
    {
        $this->gNumber = $gNumber;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLastChangeDate(): ?\DateTimeInterface
    {
        return $this->lastChangeDate;
    }

    public function setLastChangeDate(\DateTimeInterface $lastChangeDate): self
    {
        $this->lastChangeDate = $lastChangeDate;

        return $this;
    }

    public function getSupplierArticle(): ?string
    {
        return $this->supplierArticle;
    }

    public function setSupplierArticle(?string $supplierArticle): self
    {
        $this->supplierArticle = $supplierArticle;

        return $this;
    }

    public function getTechSize(): ?string
    {
        return $this->techSize;
    }

    public function setTechSize(?string $techSize): self
    {
        $this->techSize = $techSize;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getDiscountPercent(): ?int
    {
        return $this->discountPercent;
    }

    public function setDiscountPercent(?int $discountPercent): self
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    public function getIsSupply(): ?bool
    {
        return $this->isSupply;
    }

    public function setIsSupply(?bool $isSupply): self
    {
        $this->isSupply = $isSupply;

        return $this;
    }

    public function getIsRealization(): ?bool
    {
        return $this->isRealization;
    }

    public function setIsRealization(?bool $isRealization): self
    {
        $this->isRealization = $isRealization;

        return $this;
    }

    public function getPromoCodeDiscount(): ?float
    {
        return $this->promoCodeDiscount;
    }

    public function setPromoCodeDiscount(?float $promoCodeDiscount): self
    {
        $this->promoCodeDiscount = $promoCodeDiscount;

        return $this;
    }

    public function getWarehouseName(): ?string
    {
        return $this->warehouseName;
    }

    public function setWarehouseName(?string $warehouseName): self
    {
        $this->warehouseName = $warehouseName;

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(?string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getOblastOkrugName(): ?string
    {
        return $this->oblastOkrugName;
    }

    public function setOblastOkrugName(?string $oblastOkrugName): self
    {
        $this->oblastOkrugName = $oblastOkrugName;

        return $this;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(?string $regionName): self
    {
        $this->regionName = $regionName;

        return $this;
    }

    public function getIncomeID(): ?int
    {
        return $this->incomeID;
    }

    public function setIncomeID(?int $incomeID): self
    {
        $this->incomeID = $incomeID;

        return $this;
    }

    public function getSaleID(): ?string
    {
        return $this->saleID;
    }

    public function setSaleID(?string $saleID): self
    {
        $this->saleID = $saleID;

        return $this;
    }

    public function getOdid(): ?int
    {
        return $this->odid;
    }

    public function setOdid(?int $odid): self
    {
        $this->odid = $odid;

        return $this;
    }

    public function getSpp(): ?float
    {
        return $this->spp;
    }

    public function setSpp(?float $spp): self
    {
        $this->spp = $spp;

        return $this;
    }

    public function getForPay(): ?float
    {
        return $this->forPay;
    }

    public function setForPay(?float $forPay): self
    {
        $this->forPay = $forPay;

        return $this;
    }

    public function getFinishedPrice(): ?float
    {
        return $this->finishedPrice;
    }

    public function setFinishedPrice(?float $finishedPrice): self
    {
        $this->finishedPrice = $finishedPrice;

        return $this;
    }

    public function getPriceWithDisc(): ?float
    {
        return $this->priceWithDisc;
    }

    public function setPriceWithDisc(?float $priceWithDisc): self
    {
        $this->priceWithDisc = $priceWithDisc;

        return $this;
    }

    public function getNmId(): ?int
    {
        return $this->nmId;
    }

    public function setNmId(int $nmId): self
    {
        $this->nmId = $nmId;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getIsStorno(): ?bool
    {
        return $this->isStorno;
    }

    public function setIsStorno(bool $isStorno): self
    {
        $this->isStorno = $isStorno;

        return $this;
    }

    public function getSticker(): ?string
    {
        return $this->sticker;
    }

    public function setSticker(?string $sticker): self
    {
        $this->sticker = $sticker;

        return $this;
    }

    public function getSrid(): ?string
    {
        return $this->srid;
    }

    public function setSrid(?string $srid): self
    {
        $this->srid = $srid;

        return $this;
    }
}
