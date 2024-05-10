<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Resources\Currency;

class CreatePaymentRequestDTO extends DTO
{
    protected string $order_id;

    protected Currency $currency;

    protected string $merchant_id;

    protected int $amount;

    protected string $order_desc;

    protected string $response_url;

    protected string $server_callback_url;

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

    public function getOrderDesc(): string
    {
        return $this->order_desc;
    }

    public function getResponseUrl(): string
    {
        return $this->response_url;
    }

    public function getServerCallbackUrl(): string
    {
        return $this->server_callback_url;
    }
}
