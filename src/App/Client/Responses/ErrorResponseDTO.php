<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses;

use Dots\Portmone\App\Client\Resources\Consts\ResponseStatus;

class ErrorResponseDTO extends PortmoneResponseDTO
{
    protected ?string $response_status;

    protected ?string $error_code;

    protected ?string $error_message;

    protected array $data;

    public static function fromArray(array $data): static
    {
        $data['data'] = $data;

        return parent::fromArray($data);
    }

    public function isResponseStatusSuccess(): bool
    {
        return $this->response_status === ResponseStatus::SUCCESS;
    }

    public function isResponseStatusFailure(): bool
    {
        return $this->response_status === ResponseStatus::FAILURE;
    }

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

    public function getData(): array
    {
        return $this->data;
    }
}
