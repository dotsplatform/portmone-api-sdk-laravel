<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CapturePaymentResponseDTO extends PortmoneResponseDTO
{
    public const CAPTURED_STATUS_CAPTURED = 'captured';

    protected string $order_id;

    protected string $response_status;

    protected ?string $response_code;

    protected ?string $capture_status;

    protected ?string $response_description;

    protected string $merchant_id;

    public function isSuccess(): bool
    {
        return $this->getCaptureStatus() === self::CAPTURED_STATUS_CAPTURED;
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

    public function getCaptureStatus(): ?string
    {
        return $this->capture_status;
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
