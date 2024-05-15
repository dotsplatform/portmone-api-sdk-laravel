<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments;

use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\PostPortmoneRequest;
use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentResponseDTO;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Response;

class CreatePaymentRequest extends PostPortmoneRequest
{
    private const ENDPOINT = '/gateway/'; // last slash should present

    public function __construct(
        protected readonly CreatePaymentRequestDTO $dto,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->dto->toRequestData();
    }

    public function resolveEndpoint(): string
    {
        return self::ENDPOINT;
    }

    public function createDtoFromResponse(Response $response): CreatePaymentResponseDTO
    {
        return CreatePaymentResponseDTO::fromResponse($response);
    }
}
