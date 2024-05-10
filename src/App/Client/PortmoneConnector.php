<?php
/**
 * Description of PortmoneConnector.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Dots\Portmone\App\Client\Auth\PortmoneAuthenticator;
use Dots\Portmone\App\Client\Exceptions\PortmoneException;
use Dots\Portmone\App\Client\Requests\Payments\CapturePaymentRequest;
use Dots\Portmone\App\Client\Requests\Payments\CreatePaymentRequest;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CapturePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\ReversePaymentRequestDTO;
use Dots\Portmone\App\Client\Requests\Payments\PaymentInfoRequest;
use Dots\Portmone\App\Client\Requests\Payments\ReversePaymentRequest;
use Dots\Portmone\App\Client\Resources\PortmonePayment;
use Dots\Portmone\App\Client\Responses\ErrorResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentResponseDTO;
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
    public function createPayment(CreatePaymentRequestDTO $dto): CreatePaymentResponseDTO
    {
        $this->authenticateRequests();

        return $this->send(new CreatePaymentRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function paymentStatus(PaymentInfoRequestDTO $dto): PortmonePayment
    {
        $this->authenticateRequests();

        return $this->send(new PaymentInfoRequest($dto))->dto();
    }

    /**
     * @throws PortmoneException
     */
    public function capturePayment(CapturePaymentRequestDTO $dto): void
    {
        $this->authenticateRequests();

        $this->send(new CapturePaymentRequest($dto));
    }

    /**
     * @throws PortmoneException
     */
    public function reversePayment(ReversePaymentRequestDTO $dto): ReversePaymentResponseDTO
    {
        $this->authenticateRequests();

        return $this->send(new ReversePaymentRequest($dto))->dto();
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveBaseUrl(): string
    {
        $host = config('portmone.host');
        if (! is_string($host)) {
            throw new RuntimeException('Invalid Portmone host');
        }

        return $host;
    }

    private function authenticateRequests(): void
    {
        $this->authenticate(PortmoneAuthenticator::fromAuthDTO($this->authDto));
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $errorResponse = ErrorResponseDTO::fromResponse($response);

        return new PortmoneException($errorResponse);
    }
}
