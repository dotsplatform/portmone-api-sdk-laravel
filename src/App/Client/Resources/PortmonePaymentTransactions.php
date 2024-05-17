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

    public function sortDescByPayDate(): static
    {
        return $this->sortByDesc(
            fn (PortmonePaymentTransaction $transaction) => $transaction->getPayDate(),
        );
    }

    public function getLastActualTransaction(): PortmonePaymentTransaction
    {
        return $this->sortDescByPayDate()->firstOrFail();
    }
}
