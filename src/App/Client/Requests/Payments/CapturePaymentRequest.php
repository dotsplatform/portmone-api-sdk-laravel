<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments;

use Dots\Portmone\App\Client\Requests\Payments\DTO\CapturePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\PostPortmoneRequest;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
use Saloon\Http\Response;

class CapturePaymentRequest extends PostPortmoneRequest
{
    private const ENDPOINT = '/r3/api/capture/order_id';

    public function __construct(
        protected readonly CapturePaymentRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): CapturePaymentResponseDTO
    {
        return CapturePaymentResponseDTO::fromResponse($response);
    }
}
