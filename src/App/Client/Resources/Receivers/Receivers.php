<?php
/**
 * Description of Receivers.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources\Receivers;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

/**
 * @extends Collection<int, Receiver>
 */
class Receivers extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(fn ($item) => Receiver::fromArray($item), $data));
    }

    public function getAsString(): string
    {
        $value = $this->map(fn (Receiver $receiver) => $receiver->getAsString())->implode(';');
        $value .= ';';

        return $value;
    }
}
