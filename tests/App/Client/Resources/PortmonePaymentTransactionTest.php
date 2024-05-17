<?php
/**
 * Description of PortmonePaymentTransactionTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransaction;
use Tests\Generators\PortmonePaymentTransactionDataGenerator;
use Tests\TestCase;

class PortmonePaymentTransactionTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PortmonePaymentTransaction::fromArray(
            PortmonePaymentTransactionDataGenerator::generate(),
        );

        $this->assertEquals(
            $dto->toArray(),
            PortmonePaymentTransaction::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = PortmonePaymentTransaction::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'description' => 'description',
                    'status' => PaymentStatus::CREATED,
                    'billAmount' => 200.2,
                    'attribute1' => 'attribute1',
                    'attribute2' => 'attribute2',
                    'attribute3' => 'attribute3',
                    'attribute4' => 'attribute4',
                    'commission' => 'commission',
                    'bank_id' => 'bank_id',
                    'terminal_id' => 'terminal_id',
                    'merchant_id' => 'merchant_id',
                    'rrn' => 'rrn',
                    'pay_date' => 'pay_date',
                    'payee_export_date' => 'payee_export_date',
                    'pay_order_date' => 'pay_order_date',
                    'chargeback' => 'chargeback',
                    'payee_name' => 'payee_name',
                    'payee_commission' => 'payee_commission',
                    'shopBillId' => 'shopBillId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'errorCode' => 'errorCode',
                    'errorMessage' => 'errorMessage',
                    'authCode' => 'authCode',
                    'cardMask' => 'cardMask',
                    'token' => 'token',
                    'gateType' => 'gateType',
                ],
                'expectedData' => [
                    'description' => 'description',
                    'status' => PaymentStatus::CREATED->value,
                    'billAmount' => 200.2,
                    'attribute1' => 'attribute1',
                    'attribute2' => 'attribute2',
                    'attribute3' => 'attribute3',
                    'attribute4' => 'attribute4',
                    'commission' => 'commission',
                    'bank_id' => 'bank_id',
                    'terminal_id' => 'terminal_id',
                    'merchant_id' => 'merchant_id',
                    'rrn' => 'rrn',
                    'pay_date' => 'pay_date',
                    'payee_export_date' => 'payee_export_date',
                    'pay_order_date' => 'pay_order_date',
                    'chargeback' => 'chargeback',
                    'payee_name' => 'payee_name',
                    'payee_commission' => 'payee_commission',
                    'shopBillId' => 'shopBillId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'errorCode' => 'errorCode',
                    'errorMessage' => 'errorMessage',
                    'authCode' => 'authCode',
                    'cardMask' => 'cardMask',
                    'token' => 'token',
                    'gateType' => 'gateType',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'status' => PaymentStatus::CREATED->value,
                    'billAmount' => 200.2,
                ],
                'expectedData' => [
                    'description' => null,
                    'attribute1' => null,
                    'attribute2' => null,
                    'attribute3' => null,
                    'attribute4' => null,
                    'commission' => null,
                    'bank_id' => null,
                    'terminal_id' => null,
                    'merchant_id' => null,
                    'rrn' => null,
                    'pay_date' => null,
                    'payee_export_date' => null,
                    'pay_order_date' => null,
                    'chargeback' => null,
                    'payee_name' => null,
                    'payee_commission' => null,
                    'shopBillId' => null,
                    'shopOrderNumber' => null,
                    'errorCode' => null,
                    'errorMessage' => null,
                    'authCode' => null,
                    'cardMask' => null,
                    'token' => null,
                    'gateType' => null,
                ],
            ],
        ];
    }

    /**
     * @dataProvider methodsProvider
     */
    public function testMethods(
        string $method,
        array $methodData,
        array $data,
        mixed $expectedResult,
    ): void {
        $dto = PortmonePaymentTransaction::fromArray($data);
        $result = $dto->$method(...$methodData);
        if (is_array($expectedResult)) {
            $this->assertArraysEqual($expectedResult, $result);

            return;
        }
        $this->assertEquals($expectedResult, $result);
    }

    public static function methodsProvider(): array
    {
        return [
            'Test isRejected expects true' => [
                'method' => 'isRejected',
                'methodData' => [],
                'data' => [
                    'status' => PaymentStatus::REJECTED->value,
                    'billAmount' => 200.2,
                ],
                'expectedResult' => true,
            ],

            'Test isPayed expects true' => [
                'method' => 'isPayed',
                'methodData' => [],
                'data' => [
                    'status' => PaymentStatus::PAYED->value,
                    'billAmount' => 200.2,
                ],
                'expectedResult' => true,
            ],

            'Test isPreauth expects true' => [
                'method' => 'isPreauth',
                'methodData' => [],
                'data' => [
                    'status' => PaymentStatus::PREAUTH->value,
                    'billAmount' => 200.2,
                ],
                'expectedResult' => true,
            ],

            'Test isCreated expects true' => [
                'method' => 'isCreated',
                'methodData' => [],
                'data' => [
                    'status' => PaymentStatus::CREATED->value,
                    'billAmount' => 200.2,
                ],
                'expectedResult' => true,
            ],
        ];
    }
}
