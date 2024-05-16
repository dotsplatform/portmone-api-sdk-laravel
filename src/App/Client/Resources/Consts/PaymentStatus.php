<?php
/**
 * Description of PaymentStatus.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources\Consts;

enum PaymentStatus: string
{
    case PAYED = 'PAYED';
    case PREAUTH = 'PREAUTH';
    case CREATED = 'CREATED';
    case REJECTED = 'REJECTED';

    public function isRejected(): bool
    {
        return $this === self::REJECTED;
    }

    public function isPayed(): bool
    {
        return $this === self::PAYED;
    }

    public function isPreauth(): bool
    {
        return $this === self::PREAUTH;
    }

    public function isCreated(): bool
    {
        return $this === self::CREATED;
    }
}
