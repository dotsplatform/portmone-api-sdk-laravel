<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Dots\Portmone\App\Client\Auth\PortmoneSignature;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Resources\Order;
use Dots\Portmone\App\Client\Resources\Payee;

class CreatePaymentRequestDTO extends DTO
{
    protected Method $method = Method::CREATE_LINK_PAYMENT;

    protected Payee $payee;

    protected Order $order;

    public function toRequestData(PortmoneAuthDTO $authDTO): array
    {
        $this->getPayee()->setSignature(
            PortmoneSignature::generateForPaymentCreate($authDTO, $this),
        );

        return $this->toArray();
    }

    public function getPayee(): Payee
    {
        return $this->payee;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }
}
