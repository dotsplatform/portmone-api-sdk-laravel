<?php
/**
 * Description of Order.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources;

use Dots\Data\Entity;
use Dots\Portmone\App\Client\Resources\Consts\Currency;
use Dots\Portmone\App\Client\Resources\Consts\Preauth;

class Order extends Entity
{
    protected string $shopOrderNumber;

    protected float $billAmount;

    protected string $successUrl;

    protected string $failureUrl;

    protected Preauth $preauthFlag;

    protected ?string $preauthConfirm;

    protected ?string $preauthReject;

    protected Currency $billCurrency;

    protected ?string $expTime;

    protected ?string $attribute5;

    public function getShopOrderNumber(): string
    {
        return $this->shopOrderNumber;
    }

    public function getBillAmount(): float
    {
        return $this->billAmount;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function getPreauthFlag(): Preauth
    {
        return $this->preauthFlag;
    }

    public function getPreauthConfirm(): ?string
    {
        return $this->preauthConfirm;
    }

    public function getPreauthReject(): ?string
    {
        return $this->preauthReject;
    }

    public function getBillCurrency(): Currency
    {
        return $this->billCurrency;
    }

    public function getExpTime(): ?string
    {
        return $this->expTime;
    }

    public function getAttribute5(): ?string
    {
        return $this->attribute5;
    }
}
