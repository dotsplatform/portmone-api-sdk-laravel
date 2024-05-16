<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CapturePaymentResponseDTO extends PortmoneResponseDTO
{
    protected ?string $shop_bill_id;

    protected ?string $shop_order_number;

    protected ?string $description;

    protected ?string $bill_date;

    protected ?string $pay_date;

    protected ?string $pay_order_date;

    protected float $bill_amount;

    protected ?string $auth_code;

    protected PaymentStatus $status;

    protected ?string $attribute1;

    protected ?string $attribute2;

    protected ?string $error_code;

    protected ?string $error_message;

    public function isPayed(): bool
    {
        return $this->getStatus()->isPayed();
    }

    public function getShopBillId(): ?string
    {
        return $this->shop_bill_id;
    }

    public function getShopOrderNumber(): ?string
    {
        return $this->shop_order_number;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getBillDate(): ?string
    {
        return $this->bill_date;
    }

    public function getPayDate(): ?string
    {
        return $this->pay_date;
    }

    public function getPayOrderDate(): ?string
    {
        return $this->pay_order_date;
    }

    public function getBillAmount(): float
    {
        return $this->bill_amount;
    }

    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }

    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function getAttribute1(): ?string
    {
        return $this->attribute1;
    }

    public function getAttribute2(): ?string
    {
        return $this->attribute2;
    }

    public function getErrorCode(): ?string
    {
        return $this->error_code;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }
}
