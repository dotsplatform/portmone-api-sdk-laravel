<?php
/**
 * Description of Payee.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources;

use Dots\Data\Entity;

class Payee extends Entity
{
    protected string $payeeId;

    protected string $login;

    protected string $dt;

    protected ?string $signature;

    protected ?string $shopSiteId;

    public function getPayeeId(): string
    {
        return $this->payeeId;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getDt(): string
    {
        return $this->dt;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(?string $signature): void
    {
        $this->signature = $signature;
    }

    public function getShopSiteId(): ?string
    {
        return $this->shopSiteId;
    }
}
