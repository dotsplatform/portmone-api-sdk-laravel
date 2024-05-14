<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Resources\Order;
use Dots\Portmone\App\Client\Resources\Payee;

class CreatePaymentRequestDTO extends DTO
{
    protected Payee $payee;

    protected Order $order;

    public function toRequestData(): array
    {
        return [
            'bodyRequest' => json_encode($this->toArray()),
            'typeRequest' => 'json',
        ];
    }

    public function getPayee(): Payee
    {
        return $this->payee;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
