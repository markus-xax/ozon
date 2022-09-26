<?php

namespace App\Entity;

use App\Repository\WbIncomeDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbIncomeDataRepository::class)]
class WbIncomeData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbIncomeData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;

    #[ORM\Column(type: 'integer')]
    private $incomeId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $number;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

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

    #[ORM\Column(type: 'float', nullable: true)]
    private $totalPrice;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateClose;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $warehouseName;

    #[ORM\Column(type: 'integer')]
    private $nmId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

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

    public function getIncomeId(): ?int
    {
        return $this->incomeId;
    }

    public function setIncomeId(int $incomeId): self
    {
        $this->incomeId = $incomeId;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getDateClose(): ?\DateTimeInterface
    {
        return $this->dateClose;
    }

    public function setDateClose(\DateTimeInterface $dateClose): self
    {
        $this->dateClose = $dateClose;

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

    public function getNmId(): ?int
    {
        return $this->nmId;
    }

    public function setNmId(int $nmId): self
    {
        $this->nmId = $nmId;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
