<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Resources\Currency;

class PaymentInfoRequestDTO extends DTO
{
    protected string $order_id;

    protected string $merchant_id;

    protected string $order_desc;

    public function toRequestData(): array
    {
        return [
            'request' => $this->toArray(),
        ];
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getMerchantId(): string
    {
        return $this->merchant_id;
    }

    public function getOrderDesc(): string
    {
        return $this->order_desc;
    }
}
