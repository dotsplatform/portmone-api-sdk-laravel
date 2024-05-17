<?php
/**
 * Description of PortmonePaymentTransactionDataGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\Generators;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Illuminate\Support\Str;

class PortmonePaymentTransactionDataGenerator
{
    public static function generate(array $data = []): array
    {
        return array_merge([
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
        ], $data);
    }
}
