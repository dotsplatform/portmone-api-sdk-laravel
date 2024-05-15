<?php
/**
 * Description of Method.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO\Consts;

enum Method: string
{
    case CONFIRM_PREAUTH = 'confirmPreauth';

    case PREAUTH = 'preauth';
    case RESULT = 'result';
    case CREATE_LINK_PAYMENT = 'createLinkPayment';
}
