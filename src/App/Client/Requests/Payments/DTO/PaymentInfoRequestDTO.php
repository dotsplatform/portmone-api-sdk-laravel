<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;

class PaymentInfoRequestDTO extends DTO
{
    public const ID = '1';

    protected string $login;

    protected string $password;

    protected string $payeeId;

    protected ?string $shopOrderNumber;

    protected ?string $shopbillId;

    protected ?PaymentStatus $status;

    protected ?string $startDate;

    protected ?string $endDate;

    public function toRequestData(): array
    {
        return [
            'method' => Method::RESULT->value,
            'id' => self::ID,
            'request' => [
                'data' => [
                    'login' => $this->getLogin(),
                    'password' => $this->getPassword(),
                    'payeeId' => $this->getPayeeId(),
                    'shopOrderNumber' => $this->getShopOrderNumber(),
                    'shopbillId' => $this->getShopbillId(),
                    'status' => $this->getStatus()?->value,
                    'startDate' => $this->getStartDate(),
                    'endDate' => $this->getEndDate(),
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

    public function getStatus(): ?PaymentStatus
    {
        return $this->status;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }
}
