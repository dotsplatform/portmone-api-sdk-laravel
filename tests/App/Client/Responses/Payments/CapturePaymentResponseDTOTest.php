<?php
/**
 * Description of CapturePaymentResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Responses\Payments\CapturePaymentResponseDTO;
use Tests\TestCase;

class CapturePaymentResponseDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CapturePaymentResponseDTO::fromArray([
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
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CapturePaymentResponseDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CapturePaymentResponseDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'shop_bill_id' => 'shop_bill_id',
                    'shop_order_number' => 'shop_order_number',
                    'description' => 'description',
                    'bill_date' => 'bill_date',
                    'pay_date' => 'pay_date',
                    'pay_order_date' => 'pay_order_date',
                    'bill_amount' => 200,
                    'auth_code' => 'auth_code',
                    'status' => PaymentStatus::PAYED,
                    'attribute1' => 'attribute1',
                    'attribute2' => 'attribute2',
                    'error_code' => 'error_code',
                    'error_message' => 'error_message',
                ],
                'expectedData' => [
                    'shop_bill_id' => 'shop_bill_id',
                    'shop_order_number' => 'shop_order_number',
                    'description' => 'description',
                    'bill_date' => 'bill_date',
                    'pay_date' => 'pay_date',
                    'pay_order_date' => 'pay_order_date',
                    'bill_amount' => 200,
                    'auth_code' => 'auth_code',
                    'status' => PaymentStatus::PAYED->value,
                    'attribute1' => 'attribute1',
                    'attribute2' => 'attribute2',
                    'error_code' => 'error_code',
                    'error_message' => 'error_message',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'bill_amount' => 100,
                    'status' => PaymentStatus::PAYED,
                ],
                'expectedData' => [
                    'shop_bill_id' => null,
                    'shop_order_number' => null,
                    'description' => null,
                    'bill_date' => null,
                    'pay_date' => null,
                    'pay_order_date' => null,
                    'auth_code' => null,
                    'attribute1' => null,
                    'attribute2' => null,
                    'error_code' => null,
                    'error_message' => null,
                ],
            ],
        ];
    }
}
