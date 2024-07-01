<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments;

use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentTransactionsRequestDTO;
use Dots\Portmone\App\Client\Requests\PostPortmoneRequest;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Saloon\Http\Response;

class PaymentTransactionsRequest extends PostPortmoneRequest
{
    private const ENDPOINT = '/gateway/';

    public function __construct(
        protected readonly PaymentTransactionsRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): PortmonePaymentTransactions
    {
        return PortmonePaymentTransactions::fromArray($response->json());
    }
}
