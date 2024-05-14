<?php
/**
 * Description of Payment.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources;

use Dots\Data\Entity;
use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;

class PortmonePayment extends Entity
{
    protected string $description;

    protected PaymentStatus $status;

    protected float $billAmount;

    protected ?string $attribute1;

    protected ?string $attribute2;

    protected ?string $attribute3;

    protected ?string $attribute4;

    protected ?string $commission;

    protected ?string $bank_id;

    protected ?string $terminal_id;

    protected ?string $merchant_id;

    protected ?string $rrn;

    protected ?string $pay_date;

    protected ?string $payee_export_date;

    protected ?string $pay_order_date;

    protected ?string $chargeback;

    protected ?string $payee_name;

    protected ?string $payee_commission;

    protected ?string $shopBillId;

    protected ?string $shopOrderNumber;

    protected ?string $errorCode;

    protected ?string $errorMessage;

    protected ?string $authCode;

    protected ?string $cardMask;

    protected ?string $token;

    protected ?string $gateType;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function getBillAmount(): float
    {
        return $this->billAmount;
    }

    public function getAttribute1(): ?string
    {
        return $this->attribute1;
    }

    public function getAttribute2(): ?string
    {
        return $this->attribute2;
    }

    public function getAttribute3(): ?string
    {
        return $this->attribute3;
    }

    public function getAttribute4(): ?string
    {
        return $this->attribute4;
    }

    public function getCommission(): ?string
    {
        return $this->commission;
    }

    public function getBankId(): ?string
    {
        return $this->bank_id;
    }

    public function getTerminalId(): ?string
    {
        return $this->terminal_id;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchant_id;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getPayDate(): ?string
    {
        return $this->pay_date;
    }

    public function getPayeeExportDate(): ?string
    {
        return $this->payee_export_date;
    }

    public function getPayOrderDate(): ?string
    {
        return $this->pay_order_date;
    }

    public function getChargeback(): ?string
    {
        return $this->chargeback;
    }

    public function getPayeeName(): ?string
    {
        return $this->payee_name;
    }

    public function getPayeeCommission(): ?string
    {
        return $this->payee_commission;
    }

    public function getShopBillId(): ?string
    {
        return $this->shopBillId;
    }

    public function getShopOrderNumber(): ?string
    {
        return $this->shopOrderNumber;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function getAuthCode(): ?string
    {
        return $this->authCode;
    }

    public function getCardMask(): ?string
    {
        return $this->cardMask;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getGateType(): ?string
    {
        return $this->gateType;
    }
}
