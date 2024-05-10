<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses;

class ErrorResponseDTO extends PortmoneResponseDTO
{
    protected ?string $response_status;

    protected ?string $error_code;

    protected ?string $error_message;

    public function getResponseStatus(): ?string
    {
        return $this->response_status;
    }

    public function getErrorCode(): ?string
    {
        return $this->error_code;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }
}
