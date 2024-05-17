<?php
/**
 * Description of CapturePaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Portmone\App\Client\Requests\Payments\DTO\CapturePaymentRequestDTO;
use Dots\Portmone\App\Client\Resources\Receivers\Receivers;
use Tests\TestCase;

class CapturePaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CapturePaymentRequestDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
            'payeeId' => $this->uuid(),
            'shopOrderNumber' => $this->uuid(),
            'shopbillId' => $this->uuid(),
            'postauthAmount' => 100,
            'distribution' => Receivers::fromArray([
                [
                    'payeeId' => $this->uuid(),
                    'amount' => 100.0,
                    'description' => $this->uuid(),
                ],
            ]),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CapturePaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CapturePaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'shopbillId' => 'shopbillId',
                    'postauthAmount' => 100,
                    'distribution' => Receivers::fromArray([
                        [
                            'payeeId' => 'receiver_payeeId',
                            'amount' => 100,
                            'description' => 'receiver_description',
                        ],
                    ]),
                ],
                'expectedData' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'shopbillId' => 'shopbillId',
                    'postauthAmount' => 100,
                    'distribution' => [
                        [
                            'payeeId' => 'receiver_payeeId',
                            'amount' => 100,
                            'description' => 'receiver_description',
                        ],
                    ],
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                ],
                'expectedData' => [
                    'shopOrderNumber' => null,
                    'shopbillId' => null,
                    'postauthAmount' => null,
                    'distribution' => null,
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
        $dto = CapturePaymentRequestDTO::fromArray($data);
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
            'Test toRequestData expects data' => [
                'method' => 'toRequestData',
                'methodData' => [],
                'data' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'shopbillId' => 'shopbillId',
                    'postauthAmount' => 100,
                    'distribution' => Receivers::fromArray([
                        [
                            'payeeId' => 'receiver_payeeId_1',
                            'amount' => 30,
                            'description' => 'receiver_description_1',
                        ],
                        [
                            'payeeId' => 'receiver_payeeId_2',
                            'amount' => 70,
                            'description' => 'receiver_description_2',
                        ],
                    ]),
                ],
                'expectedResult' => [
                    'method' => 'confirmPreauth',
                    'id' => CapturePaymentRequestDTO::ID,
                    'params' => [
                        'data' => [
                            'login' => 'login',
                            'password' => 'password',
                            'payeeId' => 'payeeId',
                            'shopOrderNumber' => 'shopOrderNumber',
                            'shopbillId' => 'shopbillId',
                            'postauthAmount' => 100,
                            'distribution' => 'receiver_description_1:receiver_payeeId_1;30;receiver_description_2:receiver_payeeId_2;70;',
                        ],
                    ],
                ],
            ],
        ];
    }
}
