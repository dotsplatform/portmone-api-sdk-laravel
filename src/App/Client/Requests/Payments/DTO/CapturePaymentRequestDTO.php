<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Resources\Currency;

class CapturePaymentRequestDTO extends DTO
{
    protected string $order_id;

    protected Currency $currency;

    protected int $amount;

    protected string $merchant_id;

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getMerchantId(): string
    {
        return $this->merchant_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
