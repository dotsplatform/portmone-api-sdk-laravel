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
use Saloon\Http\Response;

class CreatePaymentRequest extends PostPortmoneRequest
{
    private const ENDPOINT = '/r3/api/checkout/url';

    public function __construct(
        protected readonly CreatePaymentRequestDTO $dto,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->dto->toArray();
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
