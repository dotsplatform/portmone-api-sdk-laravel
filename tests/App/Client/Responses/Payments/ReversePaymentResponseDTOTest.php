<?php
/**
 * Description of ReversePaymentResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Responses\Payments\ReversePaymentResponseDTO;
use Tests\TestCase;

class ReversePaymentResponseDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ReversePaymentResponseDTO::fromArray([
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
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ReversePaymentResponseDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ReversePaymentResponseDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
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
                ],
                'expectedData' => [
                    'shop_bill_id' => 'shop_bill_id',
                    'bill_number' => 'bill_number',
                    'description' => 'description',
                    'bill_amount' => 100,
                    'status' => PaymentStatus::REJECTED->value,
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
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'bill_amount' => 100,
                    'status' => PaymentStatus::REJECTED,
                ],
                'expectedData' => [
                    'shop_bill_id' => null,
                    'bill_number' => null,
                    'description' => null,
                    'bank_id' => null,
                    'terminal_id' => null,
                    'merchant_id' => null,
                    'rrn' => null,
                    'auth_code' => null,
                    'attribute1' => null,
                    'attribute2' => null,
                    'attribute3' => null,
                    'attribute4' => null,
                    'attribute6' => null,
                    'commission' => null,
                    'error_code' => null,
                    'error_message' => null,
                ],
            ],
        ];
    }
}
