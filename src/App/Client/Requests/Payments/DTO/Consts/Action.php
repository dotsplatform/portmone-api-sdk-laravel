<?php
/**
 * Description of Action.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO\Consts;

enum Action: string
{
    case REJECT = 'reject';
}
