<?php
/**
 * Description of PortmoneAuthDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Auth\DTO;

use Dots\Data\DTO;

class PortmoneAuthDTO extends DTO
{
    protected string $merchantId;

    protected string $password;

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
