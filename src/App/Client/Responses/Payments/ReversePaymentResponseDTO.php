<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class ReversePaymentResponseDTO extends PortmoneResponseDTO
{
    public const REVERSE_STATUS_SUCCESS = 'success';

    protected string $order_id;

    protected string $response_status;

    protected ?string $response_code;

    protected ?string $reverse_status;

    protected ?string $response_description;

    protected string $merchant_id;

    public function isSuccess(): bool
    {
        return $this->getReverseStatus() === self::REVERSE_STATUS_SUCCESS;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getResponseStatus(): string
    {
        return $this->response_status;
    }

    public function getResponseCode(): ?string
    {
        return $this->response_code;
    }

    public function getReverseStatus(): ?string
    {
        return $this->reverse_status;
    }

    public function getResponseDescription(): ?string
    {
        return $this->response_description;
    }

    public function getMerchantId(): string
    {
        return $this->merchant_id;
    }
}
