<?php
/**
 * Description of PortmonePaymentsResponseMocker.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\Mocks\Payments;

use Dots\Portmone\App\Client\Requests\Payments\CapturePaymentRequest;
use Dots\Portmone\App\Client\Requests\Payments\CreatePaymentLinkRequest;
use Dots\Portmone\App\Client\Requests\Payments\PaymentInfoRequest;
use Dots\Portmone\App\Client\Requests\Payments\ReversePaymentRequest;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentLinkResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\ReversePaymentResponseDTO;
use Dots\Portmone\Mocks\Payments\Generators\PortmoneResponseDemoDataGenerator;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

class PortmonePaymentsResponseMocker
{
    public static function mockSuccessCreatePaymentLink(array $data = []): CreatePaymentLinkResponseDTO
    {
        $dto = PortmoneResponseDemoDataGenerator::generateSuccessCreatePaymentLinkResponse($data);
        MockClient::global([
            CreatePaymentLinkRequest::class => MockResponse::make($dto->toArray(), ),
        ]);

        return $dto;
    }

    public static function mockSuccessPaymentTransactions(array $data = []): PortmonePaymentTransactions
    {
        $dto = PortmoneResponseDemoDataGenerator::generatePaymentTransactions($data);
        MockClient::global([
            PaymentInfoRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessCapture(array $data = []): CapturePaymentResponseDTO
    {
        $dto = PortmoneResponseDemoDataGenerator::generateSuccessCapturePaymentResponse($data);
        MockClient::global([
            CapturePaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessReverse(array $data = []): ReversePaymentResponseDTO
    {
        $dto = PortmoneResponseDemoDataGenerator::generateSuccessReversePaymentResponse($data);
        MockClient::global([
            ReversePaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockFailCreatePaymentLink(array $data = []): array
    {
        $data = PortmoneResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            CreatePaymentLinkRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailCapturePayment(array $data = []): array
    {
        $data = PortmoneResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            CapturePaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailReversePayment(array $data = []): array
    {
        $data = PortmoneResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            ReversePaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }
}
