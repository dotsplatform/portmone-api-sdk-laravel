<?php
/**
 * Description of PortmoneOperationGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\Mocks\Payments\Generators;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentLinkResponseDTO;
use Dots\Portmone\App\Client\Responses\Payments\ReversePaymentResponseDTO;
use Illuminate\Support\Str;

class PortmoneResponseDemoDataGenerator
{
    public static function generateBadRequestResponse(array $data = []): array
    {
        return array_merge([
            'error' => Str::uuid()->toString(),
            'error_code' => Str::uuid()->toString(),
        ], $data);
    }

    public static function generateSuccessCreatePaymentLinkResponse(array $data = []): CreatePaymentLinkResponseDTO
    {
        return CreatePaymentLinkResponseDTO::fromArray(array_merge([
            'linkPayment' => 'https://blackhole.com',
        ], $data));
    }

    public static function generateSuccessCapturePaymentResponse(array $data = []): CapturePaymentResponseDTO
    {
        return CapturePaymentResponseDTO::fromArray(array_merge([
            'shop_bill_id' => 'shop_bill_id',
            'shop_order_number' => 'shop_order_number',
            'description' => 'description',
            'bill_date' => 'bill_date',
            'pay_date' => 'pay_date',
            'pay_order_date' => 'pay_order_date',
            'bill_amount' => 100,
            'auth_code' => 'auth_code',
            'status' => PaymentStatus::PAYED,
            'attribute1' => 'attribute1',
            'attribute2' => 'attribute2',
            'error_code' => 'error_code',
            'error_message' => 'error_message',
        ], $data));
    }

    public static function generateSuccessReversePaymentResponse(array $data = []): ReversePaymentResponseDTO
    {
        return ReversePaymentResponseDTO::fromArray(array_merge([
            'shop_bill_id' => 'shop_bill_id',
            'bill_number' => 'bill_number',
            'description' => 'description',
            'bill_amount' => 100,
            'status' => PaymentStatus::REJECTED,
            'bank_id' => 'bank_id',
            'terminal_id' => 'terminal_id',
            'merchant_id' => 'merchant_id',
            'rrn' => 'rrn',
            'auth_code' => 'auth_code',
            'attribute1' => 'attribute1',
            'attribute2' => 'attribute2',
            'attribute3' => 'attribute3',
            'attribute4' => 'attribute4',
            'attribute6' => 'attribute6',
            'commission' => 'commission',
            'error_code' => 'error_code',
            'error_message' => 'error_message',
        ], $data));
    }

    public static function generatePaymentTransactions(array $lastTransactionData = []): PortmonePaymentTransactions
    {
        $operations = [
            self::generatePreauth(),
            self::generatePayed(),
            self::generateRejected(),
        ];

        if (! empty($lastTransactionData)) {
            $operations[] = self::generateOperation($lastTransactionData);
        }

        return PortmonePaymentTransactions::make($operations);
    }

    public static function generatePreauth(array $data = []): PortmonePaymentTransaction
    {
        return self::generateOperation(array_merge([
            'status' => PaymentStatus::PREAUTH,
        ], $data));
    }

    public static function generatePayed(array $data = []): PortmonePaymentTransaction
    {
        return self::generateOperation(array_merge([
            'status' => PaymentStatus::PAYED,
        ], $data));
    }

    public static function generateRejected(array $data = []): PortmonePaymentTransaction
    {
        return self::generateOperation(array_merge([
            'status' => PaymentStatus::REJECTED,
        ], $data));
    }

    public static function generateOperation(array $data = []): PortmonePaymentTransaction
    {
        return PortmonePaymentTransaction::fromArray(array_merge([
            'description' => Str::uuid()->toString(),
            'status' => PaymentStatus::CREATED,
            'billAmount' => 100.2,
            'attribute1' => Str::uuid()->toString(),
            'attribute2' => Str::uuid()->toString(),
            'attribute3' => Str::uuid()->toString(),
            'attribute4' => Str::uuid()->toString(),
            'commission' => Str::uuid()->toString(),
            'bank_id' => Str::uuid()->toString(),
            'terminal_id' => Str::uuid()->toString(),
            'merchant_id' => Str::uuid()->toString(),
            'rrn' => Str::uuid()->toString(),
            'pay_date' => Str::uuid()->toString(),
            'payee_export_date' => Str::uuid()->toString(),
            'pay_order_date' => Str::uuid()->toString(),
            'chargeback' => Str::uuid()->toString(),
            'payee_name' => Str::uuid()->toString(),
            'payee_commission' => Str::uuid()->toString(),
            'shopBillId' => Str::uuid()->toString(),
            'shopOrderNumber' => Str::uuid()->toString(),
            'errorCode' => Str::uuid()->toString(),
            'errorMessage' => Str::uuid()->toString(),
            'authCode' => Str::uuid()->toString(),
            'cardMask' => Str::uuid()->toString(),
            'token' => Str::uuid()->toString(),
            'gateType' => Str::uuid()->toString(),
        ], $data));
    }
}
