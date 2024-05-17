<?php
/**
 * Description of CreatePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CreatePaymentLinkResponseDTO extends PortmoneResponseDTO
{
    protected ?string $linkPayment;

    protected ?string $error;

    protected ?string $errorCode;

    public function isSuccess(): bool
    {
        if ($this->getError()) {
            return false;
        }

        return (bool) $this->getLinkPayment();
    }

    public function getLinkPayment(): ?string
    {
        return $this->linkPayment;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }
}
