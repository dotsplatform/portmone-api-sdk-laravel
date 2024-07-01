<?php
/**
 * Description of PortmonePaymentTransactionsTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Dots\Portmone\App\Client\Resources\PortmonePaymentTransactions;
use Tests\Generators\PortmonePaymentTransactionDataGenerator;
use Tests\TestCase;

class PortmonePaymentTransactionsTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PortmonePaymentTransactions::fromArray([
            PortmonePaymentTransactionDataGenerator::generate(),
            PortmonePaymentTransactionDataGenerator::generate(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            PortmonePaymentTransactions::fromArray($dto->toArray())->toArray(),
        );
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
        $dto = PortmonePaymentTransactions::fromArray($data);
        $result = $dto->$method(...$methodData);
        if (is_object($result)) {
            $result = $result->toArray();
        }

        if (is_array($expectedResult)) {
            $this->assertArraysEqual($expectedResult, $result);

            return;
        }
        $this->assertEquals($expectedResult, $result);
    }

    public static function methodsProvider(): array
    {
        return [
            'Test getLastActualTransaction expects last transaction' => [
                'method' => 'getLastActualTransaction',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::CREATED,
                        'billAmount' => 200,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                    [
                        'shopOrderNumber' => '2',
                        'status' => PaymentStatus::CREATED,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:44:33',
                    ],
                ],
                'expectedResult' => [
                    'shopOrderNumber' => '1',
                ],
            ],

            'Test getActualAmount expects from last payment if status not payed ' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::PREAUTH,
                        'billAmount' => 200,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                ],
                'expectedResult' => 200,
            ],

            'Test getActualAmount with two payed transaction expects' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::PAYED,
                        'billAmount' => 200,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                    [
                        'shopOrderNumber' => '2',
                        'status' => PaymentStatus::PAYED,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:44:33',
                    ],
                ],
                'expectedResult' => 300,
            ],

            'Test isPayed expects false if one not payed' => [
                'method' => 'isPayed',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::PAYED,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                    [
                        'shopOrderNumber' => '2',
                        'status' => PaymentStatus::PREAUTH,
                        'billAmount' => 200,
                        'pay_date' => '16.05.2024 15:46:33',
                    ],
                ],
                'expectedResult' => false,
            ],

            'Test isPayed expects true' => [
                'method' => 'isPayed',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::PAYED,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                    [
                        'shopOrderNumber' => '2',
                        'status' => PaymentStatus::PAYED,
                        'billAmount' => 200,
                        'pay_date' => '16.05.2024 15:46:33',
                    ],
                ],
                'expectedResult' => true,
            ],

            'Test isRejected expects true' => [
                'method' => 'isRejected',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::REJECTED,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                ],
                'expectedResult' => true,
            ],

            'Test isPreauth expects true' => [
                'method' => 'isPreauth',
                'methodData' => [],
                'data' => [
                    [
                        'shopOrderNumber' => '1',
                        'status' => PaymentStatus::PREAUTH,
                        'billAmount' => 100,
                        'pay_date' => '16.05.2024 15:45:33',
                    ],
                ],
                'expectedResult' => true,
            ],
        ];
    }
}
