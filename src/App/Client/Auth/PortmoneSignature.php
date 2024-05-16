<?php
/**
 * Description of PortmoneSignature.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Auth;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentLinkRequestDTO;

class PortmoneSignature
{
    public static function generateForPaymentCreate(
        PortmoneAuthDTO $authDTO,
        CreatePaymentLinkRequestDTO $dto,
    ): string {
        $shopOrderNumber = $dto->getOrder()->getShopOrderNumber();
        $billAmount = $dto->getOrder()->getBillAmount();
        $dt = $dto->getPayee()->getDt();
        $strToSignature = $authDTO->getPayeeId().$dt.bin2hex($shopOrderNumber).$billAmount;
        $strToSignature = strtoupper($strToSignature).strtoupper(bin2hex($authDTO->getLogin()));

        return strtoupper(hash_hmac('sha256', $strToSignature, $authDTO->getKey()));
    }
}
