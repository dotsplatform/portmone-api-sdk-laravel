<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments;

use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\Portmone\App\Client\Requests\PostPortmoneRequest;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Saloon\Http\Response;

class PaymentInfoRequest extends PostPortmoneRequest
{
    private const ENDPOINT = '/gateway/';

    public function __construct(
        protected readonly PaymentInfoRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): PortmonePaymentTransaction
    {
        return PortmonePaymentTransactions::fromArray($response->json())->getLastActualTransaction();
    }
}
