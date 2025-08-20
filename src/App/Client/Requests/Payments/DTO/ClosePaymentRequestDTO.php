<?php
/**
 * Description of ClosePaymentRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Bogdan Mamontov <bohdan.mamontov@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;

class ClosePaymentRequestDTO extends DTO
{
    protected string $login;

    protected string $password;

    protected string $payeeId;

    protected ?string $shopOrderNumber;

    public function toRequestData(): array
    {
        return [
            'method' => Method::CLOSE_INVOICE->value,
            'params' => [
                'data' => [
                    'login' => $this->getLogin(),
                    'password' => $this->getPassword(),
                    'payeeId' => $this->getPayeeId(),
                    'shopOrderNumber' => $this->getShopOrderNumber(),
                ],
            ],
        ];
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPayeeId(): string
    {
        return $this->payeeId;
    }

    public function getShopOrderNumber(): ?string
    {
        return $this->shopOrderNumber;
    }
}
