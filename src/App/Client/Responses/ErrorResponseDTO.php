<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses;

class ErrorResponseDTO extends PortmoneResponseDTO
{
    protected ?string $error_code;

    protected ?string $error;

    protected array $data;

    public static function fromArray(array $data): static
    {
        $data['data'] = $data;

        return parent::fromArray($data);
    }

    public function isResponseSuccess(): bool
    {
        return empty($this->getError());
    }

    public function getErrorCode(): ?string
    {
        return $this->error_code;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
