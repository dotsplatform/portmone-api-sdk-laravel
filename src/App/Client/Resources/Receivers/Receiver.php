<?php
/**
 * Description of Receiver.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources\Receivers;

use Dots\Data\Entity;

class Receiver extends Entity
{
    protected string $payeeId;

    protected float $amount;

    protected string $description;

    public function getPayeeId(): string
    {
        return $this->payeeId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAsString(): string
    {
        return $this->getDescription().':'.$this->getPayeeId().';'.$this->getAmount();
    }
}
