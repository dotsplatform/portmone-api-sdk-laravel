<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CreatePaymentResponseDTO extends PortmoneResponseDTO
{
    protected string $response_status;

    protected string $checkout_url;

    public function getResponseStatus(): string
    {
        return $this->response_status;
    }

    public function getCheckoutUrl(): string
    {
        return $this->checkout_url;
    }
}
