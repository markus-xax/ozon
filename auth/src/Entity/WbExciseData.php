<?php

namespace App\Entity;

use App\Repository\WbExciseDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbExciseDataRepository::class)]
class WbExciseData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbExciseData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $iid;

    #[ORM\Column(type: 'float', nullable: true)]
    private $finishedPrice;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $operationTypeId;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fiscalDt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $docNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fnNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $regNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $excise;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

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

    public function getIid(): ?int
    {
        return $this->iid;
    }

    public function setIid(?int $iid): self
    {
        $this->iid = $iid;

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

    public function getOperationTypeId(): ?int
    {
        return $this->operationTypeId;
    }

    public function setOperationTypeId(?int $operationTypeId): self
    {
        $this->operationTypeId = $operationTypeId;

        return $this;
    }

    public function getFiscalDt(): ?\DateTimeInterface
    {
        return $this->fiscalDt;
    }

    public function setFiscalDt(?\DateTimeInterface $fiscalDt): self
    {
        $this->fiscalDt = $fiscalDt;

        return $this;
    }

    public function getDocNumber(): ?int
    {
        return $this->docNumber;
    }

    public function setDocNumber(?int $docNumber): self
    {
        $this->docNumber = $docNumber;

        return $this;
    }

    public function getFnNumber(): ?string
    {
        return $this->fnNumber;
    }

    public function setFnNumber(?string $fnNumber): self
    {
        $this->fnNumber = $fnNumber;

        return $this;
    }

    public function getRegNumber(): ?string
    {
        return $this->regNumber;
    }

    public function setRegNumber(?string $regNumber): self
    {
        $this->regNumber = $regNumber;

        return $this;
    }

    public function getExcise(): ?string
    {
        return $this->excise;
    }

    public function setExcise(?string $excise): self
    {
        $this->excise = $excise;

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
}
