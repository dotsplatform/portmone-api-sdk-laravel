<?php
/**
 * Description of CreatePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CreatePaymentResponseDTO extends PortmoneResponseDTO
{
    protected ?string $linkPayment;

    protected ?string $error;

    protected ?string $errorMessage;

    public function isSuccess(): bool
    {
        if (! empty($this->error)) {
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

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
