<?php
/**
 * Description of PaymentInfoRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\Portmone\App\Client\Resources\Consts\PaymentStatus;
use Tests\TestCase;

class PaymentInfoRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PaymentInfoRequestDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
            'payeeId' => $this->uuid(),
            'shopOrderNumber' => $this->uuid(),
            'shopbillId' => $this->uuid(),
            'status' => PaymentStatus::CREATED,
            'startDate' => $this->uuid(),
            'endDate' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            PaymentInfoRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = PaymentInfoRequestDTO::fromArray($data);
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
                    'status' => PaymentStatus::CREATED->value,
                    'startDate' => 'startDate',
                    'endDate' => 'endDate',
                ],
                'expectedData' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'shopOrderNumber' => 'shopOrderNumber',
                    'shopbillId' => 'shopbillId',
                    'status' => PaymentStatus::CREATED->value,
                    'startDate' => 'startDate',
                    'endDate' => 'endDate',
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
                    'status' => null,
                    'startDate' => null,
                    'endDate' => null,
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
        $dto = PaymentInfoRequestDTO::fromArray($data);
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
                    'status' => PaymentStatus::CREATED->value,
                    'startDate' => 'startDate',
                    'endDate' => 'endDate',
                ],
                'expectedResult' => [
                    'method' => Method::RESULT->value,
                    'id' => PaymentInfoRequestDTO::ID,
                    'params' => [
                        'data' => [
                            'login' => 'login',
                            'password' => 'password',
                            'payeeId' => 'payeeId',
                            'shopOrderNumber' => 'shopOrderNumber',
                            'shopbillId' => 'shopbillId',
                            'status' => PaymentStatus::CREATED->value,
                            'startDate' => 'startDate',
                            'endDate' => 'endDate',
                        ],
                    ],
                ],
            ],
        ];
    }
}
