<?php

namespace App\Entity;

use App\Repository\WbStockDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbStockDataRepository::class)]
class WbStockData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbStockData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;

    #[ORM\Column(type: 'datetime')]
    private $lastChangeDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $supplierArticle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $techSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $barcode;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantity;

    #[ORM\Column(type: 'boolean')]
    private $isSupply;

    #[ORM\Column(type: 'boolean')]
    private $isRealization;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantityFull;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantityNotInOrders;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $warehouse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $warehouseName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $inWayToClient;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $inWayFromClient;

    #[ORM\Column(type: 'integer')]
    private $nmId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $daysOnSite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $SCCode;

    #[ORM\Column(type: 'float', nullable: true)]
    private $Price;

    #[ORM\Column(type: 'float', nullable: true)]
    private $Discount;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIsSupply(): ?bool
    {
        return $this->isSupply;
    }

    public function setIsSupply(bool $isSupply): self
    {
        $this->isSupply = $isSupply;

        return $this;
    }

    public function getIsRealization(): ?bool
    {
        return $this->isRealization;
    }

    public function setIsRealization(bool $isRealization): self
    {
        $this->isRealization = $isRealization;

        return $this;
    }

    public function getQuantityFull(): ?int
    {
        return $this->quantityFull;
    }

    public function setQuantityFull(?int $quantityFull): self
    {
        $this->quantityFull = $quantityFull;

        return $this;
    }

    public function getQuantityNotInOrders(): ?int
    {
        return $this->quantityNotInOrders;
    }

    public function setQuantityNotInOrders(?int $quantityNotInOrders): self
    {
        $this->quantityNotInOrders = $quantityNotInOrders;

        return $this;
    }

    public function getWarehouse(): ?int
    {
        return $this->warehouse;
    }

    public function setWarehouse(?int $warehouse): self
    {
        $this->warehouse = $warehouse;

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

    public function getInWayToClient(): ?int
    {
        return $this->inWayToClient;
    }

    public function setInWayToClient(?int $inWayToClient): self
    {
        $this->inWayToClient = $inWayToClient;

        return $this;
    }

    public function getInWayFromClient(): ?int
    {
        return $this->inWayFromClient;
    }

    public function setInWayFromClient(?int $inWayFromClient): self
    {
        $this->inWayFromClient = $inWayFromClient;

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

    public function getDaysOnSite(): ?int
    {
        return $this->daysOnSite;
    }

    public function setDaysOnSite(?int $daysOnSite): self
    {
        $this->daysOnSite = $daysOnSite;

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

    public function getSCCode(): ?string
    {
        return $this->SCCode;
    }

    public function setSCCode(?string $SCCode): self
    {
        $this->SCCode = $SCCode;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(?float $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }
}
