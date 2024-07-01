<?php
/**
 * Description of PortmonePaymentTransactions.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

/**
 * @extends Collection<int, PortmonePaymentTransaction>
 */
class PortmonePaymentTransactions extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $item) => PortmonePaymentTransaction::fromArray($item),
            $data,
        ));
    }

    public function getActualAmount(): float
    {
        if ($this->isPayed()) {
            return $this->getPayedActualAmount();
        }

        return $this->getLastActualTransaction()?->getBillAmount() ?? 0;
    }

    public function getPayedActualAmount(): float
    {
        $amount = 0;
        foreach ($this->all() as $transaction) {
            if ($transaction->isPayed()) {
                $amount += $transaction->getBillAmount();
            }
        }

        return $amount;
    }

    public function isPayed(): bool
    {
        return $this->isEveryTransactionPayed();
    }

    public function isEveryTransactionPayed(): bool
    {
        return $this->every(fn (PortmonePaymentTransaction $transaction) => $transaction->isPayed());
    }

    public function isRejected(): bool
    {
        return $this->getLastActualTransaction()?->isRejected() ?? false;
    }

    public function isPreauth(): bool
    {
        return $this->getLastActualTransaction()?->isPreauth() ?? false;
    }

    public function getLastActualTransaction(): ?PortmonePaymentTransaction
    {
        return $this->sortDescByPayDate()->first();
    }

    public function sortDescByPayDate(): static
    {
        return $this->sortByDesc(
            fn (PortmonePaymentTransaction $transaction) => $transaction->getPayDate(),
        );
    }
}
