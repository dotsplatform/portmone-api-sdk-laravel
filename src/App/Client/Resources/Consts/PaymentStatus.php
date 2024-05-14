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
    case CREATED = 'CREATED';
    case REJECTED = 'REJECTED';
}
