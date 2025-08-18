<?php
/**
 * Description of PortmoneConnector.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Dots\Portmone\App\Client\Exceptions\PortmoneException;
use Dots\Portmone\App\Client\Requests\Payments\CapturePaymentRequest;
use Dots\Portmone\App\Client\Requests\Payments\ClosePaymentRequest;
use Dots\Portmone\App\Client\Requests\Payments\CreatePaymentLinkRequest;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CapturePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\ClosePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentLinkRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentTransactionsRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\ReversePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\PaymentTransactionsRequest;
use Dots\Portmone\App\Client\Requests\Payments\ReversePaymentRequest;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Dots\Portmone\App\Client\Responses\ErrorResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\ClosePaymentResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentLinkResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\ReversePaymentResponseDTO;
use RuntimeException;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class PortmoneConnector extends Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly PortmoneAuthDTO $authDto,
    ) {
    }

    /**
     * @throws PortmoneException
     */
    public function createPaymentLink(CreatePaymentLinkRequestDTO $dto): CreatePaymentLinkResponseDTO
    {
        return $this->send(new CreatePaymentLinkRequest($dto, $this->authDto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function closePayment(ClosePaymentRequestDTO $dto): ClosePaymentResponseDTO
    {
        return $this->send(new ClosePaymentRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function getPaymentTransactions(PaymentTransactionsRequestDTO $dto): PortmonePaymentTransactions
    {
        return $this->send(new PaymentTransactionsRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function capturePayment(CapturePaymentRequestDTO $dto): CapturePaymentResponseDTO
    {
        return $this->send(new CapturePaymentRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function reversePayment(ReversePaymentRequestDTO $dto): ReversePaymentResponseDTO
    {
        return $this->send(new ReversePaymentRequest($dto))->dto();
    }

    public function resolveBaseUrl(): string
    {
        $host = config('portmone.host');
        if (! is_string($host)) {
            throw new RuntimeException('Invalid Portmone host');
        }

        return $host;
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $errorResponse = ErrorResponseDTO::fromResponse($response);

        return new PortmoneException($errorResponse);
    }

    public function shouldThrowRequestException(Response $response): bool
    {
        $errorResponse = ErrorResponseDTO::fromResponse($response);

        return ! $errorResponse->isResponseSuccess();
    }
}
