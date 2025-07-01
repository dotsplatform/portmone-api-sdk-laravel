<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Resources\Receivers\Receivers;

class CapturePaymentRequestDTO extends DTO
{
    public const ID = '1';

    protected string $login;

    protected string $password;

    protected string $payeeId;

    protected ?string $shopOrderNumber;

    protected ?string $shopbillId;

    protected ?float $postauthAmount;

    protected ?Receivers $distribution;

    protected ?string $attribute5;

    public function toRequestData(): array
    {
        return [
            'method' => Method::CONFIRM_PREAUTH->value,
            'id' => self::ID,
            'params' => [
                'data' => [
                    'login' => $this->getLogin(),
                    'password' => $this->getPassword(),
                    'payeeId' => $this->getPayeeId(),
                    'shopOrderNumber' => $this->getShopOrderNumber(),
                    'shopbillId' => $this->getShopbillId(),
                    'postauthAmount' => $this->getPostauthAmount(),
                    'distribution' => $this->getDistribution()?->getAsString(),
                    'attribute5' => $this->getAttribute5(),
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

    public function getShopbillId(): ?string
    {
        return $this->shopbillId;
    }

    public function getPostauthAmount(): ?float
    {
        return $this->postauthAmount;
    }

    public function getDistribution(): ?Receivers
    {
        return $this->distribution;
    }

    public function getAttribute5(): ?string
    {
        return $this->attribute5;
    }
}
