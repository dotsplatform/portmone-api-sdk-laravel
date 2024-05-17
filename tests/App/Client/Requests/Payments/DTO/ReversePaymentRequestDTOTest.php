<?php
/**
 * Description of ReversePaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Requests\Payments\DTO\ReversePaymentRequestDTO;
use Tests\TestCase;

class ReversePaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ReversePaymentRequestDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
            'payeeId' => $this->uuid(),
            'shopOrderNumber' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ReversePaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ReversePaymentRequestDTO::fromArray($data);
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
                ],
                'expectedData' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'shopOrderNumber' => 'shopOrderNumber',
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
        $dto = ReversePaymentRequestDTO::fromArray($data);
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
                ],
                'expectedResult' => [
                    'method' => Method::REJECT_PREAUTH->value,
                    'params' => [
                        'data' => [
                            'login' => 'login',
                            'password' => 'password',
                            'payeeId' => 'payeeId',
                            'shopOrderNumber' => 'shopOrderNumber',
                        ],
                    ],
                ],
            ],
        ];
    }
}
