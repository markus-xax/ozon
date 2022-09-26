<?php

namespace App\Entity;

use App\Repository\WbOrderDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbOrderDataRepository::class)]
class WbOrderData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

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

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $warehouseName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $oblast;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $incomeID;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $odid;

    #[ORM\Column(type: 'integer')]
    private $nmId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCancel;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $cancel_dt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sticker;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $srid;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbOrdersData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;


    public function getId(): ?int
    {
        return $this->id;
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

    public function setBarcode(string $barcode): self
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

    public function getWarehouseName(): ?string
    {
        return $this->warehouseName;
    }

    public function setWarehouseName(?string $warehouseName): self
    {
        $this->warehouseName = $warehouseName;

        return $this;
    }

    public function getOblast(): ?string
    {
        return $this->oblast;
    }

    public function setOblast(?string $oblast): self
    {
        $this->oblast = $oblast;

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

    public function getOdid(): ?int
    {
        return $this->odid;
    }

    public function setOdid(?int $odid): self
    {
        $this->odid = $odid;

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

    public function getIsCancel(): ?bool
    {
        return $this->isCancel;
    }

    public function setIsCancel(?bool $isCancel): self
    {
        $this->isCancel = $isCancel;

        return $this;
    }

    public function getCancelDt(): ?\DateTimeInterface
    {
        return $this->cancel_dt;
    }

    public function setCancelDt(?\DateTimeInterface $cancel_dt): self
    {
        $this->cancel_dt = $cancel_dt;

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

    public function getToken(): ?ApiToken
    {
        return $this->token;
    }

    public function setToken(?ApiToken $token): self
    {
        $this->token = $token;

        return $this;
    }

}
