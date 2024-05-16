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
use Dots\Portmone\App\Client\Requests\Payments\CreatePaymentLinkRequest;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CapturePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentLinkRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\ReversePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\PaymentInfoRequest;
use Dots\Portmone\App\Client\Requests\Payments\ReversePaymentRequest;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Dots\Portmone\App\Client\Responses\ErrorResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
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
    public function paymentInfo(PaymentInfoRequestDTO $dto): PortmonePaymentTransaction
    {
        return $this->send(new PaymentInfoRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function capturePayment(CapturePaymentRequestDTO $dto): PortmonePaymentTransaction
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
