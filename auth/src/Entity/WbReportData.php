<?php

namespace App\Entity;

use App\Repository\WbReportDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WbReportDataRepository::class)]
class WbReportData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ApiToken::class, inversedBy: 'wbReportData')]
    #[ORM\JoinColumn(nullable: false)]
    private $token;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $realizationreport_id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_from;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_to;

    #[ORM\Column(type: 'json', nullable: true)]
    private $suppliercontract_code = [];

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rid;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $rr_dt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rrd_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $gi_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject_name;

    #[ORM\Column(type: 'integer')]
    private $NM_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sa_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ts_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $barcode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $doc_type_name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantity;

    #[ORM\Column(type: 'float', nullable: true)]
    private $retail_price;

    #[ORM\Column(type: 'float', nullable: true)]
    private $retail_amount;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sale_percent;

    #[ORM\Column(type: 'float', nullable: true)]
    private $commission_percent;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $office_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $supplier_oper_name;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $order_dt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $sale_dt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $shk_id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $retail_price_withdisc_rub;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $delivery_amount;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $return_amount;

    #[ORM\Column(type: 'float', nullable: true)]
    private $delivery_rub;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $gi_box_type_name;

    #[ORM\Column(type: 'float', nullable: true)]
    private $product_discount_for_report;

    #[ORM\Column(type: 'float', nullable: true)]
    private $supplier_promo;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_spp_prc;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_kvw_prc_base;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_kvw_prc;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_sales_commission;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_for_pay;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_reward;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_vw;

    #[ORM\Column(type: 'float', nullable: true)]
    private $ppvz_vw_nds;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ppvz_office_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ppvz_office_name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ppvz_supplier_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ppvz_supplier_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ppvz_inn;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $declaration_number;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sticker_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $site_country;

    #[ORM\Column(type: 'float', nullable: true)]
    private $penalty;

    #[ORM\Column(type: 'float', nullable: true)]
    private $additional_payment;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bonus_type_name;

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

    public function getRealizationreportId(): ?int
    {
        return $this->realizationreport_id;
    }

    public function setRealizationreportId(?int $realizationreport_id): self
    {
        $this->realizationreport_id = $realizationreport_id;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->date_from;
    }

    public function setDateFrom(?\DateTimeInterface $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->date_to;
    }

    public function setDateTo(?\DateTimeInterface $date_to): self
    {
        $this->date_to = $date_to;

        return $this;
    }

    public function getSuppliercontractCode(): ?array
    {
        return $this->suppliercontract_code;
    }

    public function setSuppliercontractCode(?array $suppliercontract_code): self
    {
        $this->suppliercontract_code = $suppliercontract_code;

        return $this;
    }

    public function getRid(): ?int
    {
        return $this->rid;
    }

    public function setRid(?int $rid): self
    {
        $this->rid = $rid;

        return $this;
    }

    public function getRrDt(): ?\DateTimeInterface
    {
        return $this->rr_dt;
    }

    public function setRrDt(?\DateTimeInterface $rr_dt): self
    {
        $this->rr_dt = $rr_dt;

        return $this;
    }

    public function getRrdId(): ?int
    {
        return $this->rrd_id;
    }

    public function setRrdId(?int $rrd_id): self
    {
        $this->rrd_id = $rrd_id;

        return $this;
    }

    public function getGiId(): ?int
    {
        return $this->gi_id;
    }

    public function setGiId(?int $gi_id): self
    {
        $this->gi_id = $gi_id;

        return $this;
    }

    public function getSubjectName(): ?string
    {
        return $this->subject_name;
    }

    public function setSubjectName(?string $subject_name): self
    {
        $this->subject_name = $subject_name;

        return $this;
    }

    public function getNMId(): ?int
    {
        return $this->NM_id;
    }

    public function setNMId(int $NM_id): self
    {
        $this->NM_id = $NM_id;

        return $this;
    }

    public function getBrandName(): ?string
    {
        return $this->brand_name;
    }

    public function setBrandName(?string $brand_name): self
    {
        $this->brand_name = $brand_name;

        return $this;
    }

    public function getSaName(): ?string
    {
        return $this->sa_name;
    }

    public function setSaName(?string $sa_name): self
    {
        $this->sa_name = $sa_name;

        return $this;
    }

    public function getTsName(): ?string
    {
        return $this->ts_name;
    }

    public function setTsName(?string $ts_name): self
    {
        $this->ts_name = $ts_name;

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

    public function getDocTypeName(): ?string
    {
        return $this->doc_type_name;
    }

    public function setDocTypeName(?string $doc_type_name): self
    {
        $this->doc_type_name = $doc_type_name;

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

    public function getRetailPrice(): ?float
    {
        return $this->retail_price;
    }

    public function setRetailPrice(?float $retail_price): self
    {
        $this->retail_price = $retail_price;

        return $this;
    }

    public function getRetailAmount(): ?float
    {
        return $this->retail_amount;
    }

    public function setRetailAmount(?float $retail_amount): self
    {
        $this->retail_amount = $retail_amount;

        return $this;
    }

    public function getSalePercent(): ?int
    {
        return $this->sale_percent;
    }

    public function setSalePercent(?int $sale_percent): self
    {
        $this->sale_percent = $sale_percent;

        return $this;
    }

    public function getCommissionPercent(): ?float
    {
        return $this->commission_percent;
    }

    public function setCommissionPercent(?float $commission_percent): self
    {
        $this->commission_percent = $commission_percent;

        return $this;
    }

    public function getOfficeName(): ?string
    {
        return $this->office_name;
    }

    public function setOfficeName(?string $office_name): self
    {
        $this->office_name = $office_name;

        return $this;
    }

    public function getSupplierOperName(): ?string
    {
        return $this->supplier_oper_name;
    }

    public function setSupplierOperName(?string $supplier_oper_name): self
    {
        $this->supplier_oper_name = $supplier_oper_name;

        return $this;
    }

    public function getOrderDt(): ?\DateTimeInterface
    {
        return $this->order_dt;
    }

    public function setOrderDt(?\DateTimeInterface $order_dt): self
    {
        $this->order_dt = $order_dt;

        return $this;
    }

    public function getSaleDt(): ?\DateTimeInterface
    {
        return $this->sale_dt;
    }

    public function setSaleDt(?\DateTimeInterface $sale_dt): self
    {
        $this->sale_dt = $sale_dt;

        return $this;
    }

    public function getShkId(): ?int
    {
        return $this->shk_id;
    }

    public function setShkId(?int $shk_id): self
    {
        $this->shk_id = $shk_id;

        return $this;
    }

    public function getRetailPriceWithdiscRub(): ?float
    {
        return $this->retail_price_withdisc_rub;
    }

    public function setRetailPriceWithdiscRub(?float $retail_price_withdisc_rub): self
    {
        $this->retail_price_withdisc_rub = $retail_price_withdisc_rub;

        return $this;
    }

    public function getDeliveryAmount(): ?int
    {
        return $this->delivery_amount;
    }

    public function setDeliveryAmount(?int $delivery_amount): self
    {
        $this->delivery_amount = $delivery_amount;

        return $this;
    }

    public function getReturnAmount(): ?int
    {
        return $this->return_amount;
    }

    public function setReturnAmount(?int $return_amount): self
    {
        $this->return_amount = $return_amount;

        return $this;
    }

    public function getDeliveryRub(): ?float
    {
        return $this->delivery_rub;
    }

    public function setDeliveryRub(?float $delivery_rub): self
    {
        $this->delivery_rub = $delivery_rub;

        return $this;
    }

    public function getGiBoxTypeName(): ?string
    {
        return $this->gi_box_type_name;
    }

    public function setGiBoxTypeName(?string $gi_box_type_name): self
    {
        $this->gi_box_type_name = $gi_box_type_name;

        return $this;
    }

    public function getProductDiscountForReport(): ?float
    {
        return $this->product_discount_for_report;
    }

    public function setProductDiscountForReport(?float $product_discount_for_report): self
    {
        $this->product_discount_for_report = $product_discount_for_report;

        return $this;
    }

    public function getSupplierPromo(): ?float
    {
        return $this->supplier_promo;
    }

    public function setSupplierPromo(?float $supplier_promo): self
    {
        $this->supplier_promo = $supplier_promo;

        return $this;
    }

    public function getPpvzSppPrc(): ?float
    {
        return $this->ppvz_spp_prc;
    }

    public function setPpvzSppPrc(?float $ppvz_spp_prc): self
    {
        $this->ppvz_spp_prc = $ppvz_spp_prc;

        return $this;
    }

    public function getPpvzKvwPrcBase(): ?float
    {
        return $this->ppvz_kvw_prc_base;
    }

    public function setPpvzKvwPrcBase(?float $ppvz_kvw_prc_base): self
    {
        $this->ppvz_kvw_prc_base = $ppvz_kvw_prc_base;

        return $this;
    }

    public function getPpvzKvwPrc(): ?float
    {
        return $this->ppvz_kvw_prc;
    }

    public function setPpvzKvwPrc(?float $ppvz_kvw_prc): self
    {
        $this->ppvz_kvw_prc = $ppvz_kvw_prc;

        return $this;
    }

    public function getPpvzSalesCommission(): ?float
    {
        return $this->ppvz_sales_commission;
    }

    public function setPpvzSalesCommission(?float $ppvz_sales_commission): self
    {
        $this->ppvz_sales_commission = $ppvz_sales_commission;

        return $this;
    }

    public function getPpvzForPay(): ?float
    {
        return $this->ppvz_for_pay;
    }

    public function setPpvzForPay(?float $ppvz_for_pay): self
    {
        $this->ppvz_for_pay = $ppvz_for_pay;

        return $this;
    }

    public function getPpvzReward(): ?float
    {
        return $this->ppvz_reward;
    }

    public function setPpvzReward(?float $ppvz_reward): self
    {
        $this->ppvz_reward = $ppvz_reward;

        return $this;
    }

    public function getPpvzVw(): ?float
    {
        return $this->ppvz_vw;
    }

    public function setPpvzVw(?float $ppvz_vw): self
    {
        $this->ppvz_vw = $ppvz_vw;

        return $this;
    }

    public function getPpvzVwNds(): ?float
    {
        return $this->ppvz_vw_nds;
    }

    public function setPpvzVwNds(?float $ppvz_vw_nds): self
    {
        $this->ppvz_vw_nds = $ppvz_vw_nds;

        return $this;
    }

    public function getPpvzOfficeId(): ?int
    {
        return $this->ppvz_office_id;
    }

    public function setPpvzOfficeId(?int $ppvz_office_id): self
    {
        $this->ppvz_office_id = $ppvz_office_id;

        return $this;
    }

    public function getPpvzOfficeName(): ?string
    {
        return $this->ppvz_office_name;
    }

    public function setPpvzOfficeName(?string $ppvz_office_name): self
    {
        $this->ppvz_office_name = $ppvz_office_name;

        return $this;
    }

    public function getPpvzSupplierId(): ?int
    {
        return $this->ppvz_supplier_id;
    }

    public function setPpvzSupplierId(?int $ppvz_supplier_id): self
    {
        $this->ppvz_supplier_id = $ppvz_supplier_id;

        return $this;
    }

    public function getPpvzSupplierName(): ?string
    {
        return $this->ppvz_supplier_name;
    }

    public function setPpvzSupplierName(?string $ppvz_supplier_name): self
    {
        $this->ppvz_supplier_name = $ppvz_supplier_name;

        return $this;
    }

    public function getPpvzInn(): ?string
    {
        return $this->ppvz_inn;
    }

    public function setPpvzInn(?string $ppvz_inn): self
    {
        $this->ppvz_inn = $ppvz_inn;

        return $this;
    }

    public function getDeclarationNumber(): ?string
    {
        return $this->declaration_number;
    }

    public function setDeclarationNumber(?string $declaration_number): self
    {
        $this->declaration_number = $declaration_number;

        return $this;
    }

    public function getStickerId(): ?int
    {
        return $this->sticker_id;
    }

    public function setStickerId(?int $sticker_id): self
    {
        $this->sticker_id = $sticker_id;

        return $this;
    }

    public function getSiteCountry(): ?string
    {
        return $this->site_country;
    }

    public function setSiteCountry(?string $site_country): self
    {
        $this->site_country = $site_country;

        return $this;
    }

    public function getPenalty(): ?float
    {
        return $this->penalty;
    }

    public function setPenalty(?float $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getAdditionalPayment(): ?float
    {
        return $this->additional_payment;
    }

    public function setAdditionalPayment(?float $additional_payment): self
    {
        $this->additional_payment = $additional_payment;

        return $this;
    }

    public function getBonusTypeName(): ?string
    {
        return $this->bonus_type_name;
    }

    public function setBonusTypeName(?string $bonus_type_name): self
    {
        $this->bonus_type_name = $bonus_type_name;

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
