<?php
/**
 * Description of CreatePaymentLinkResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\Payments\CreatePaymentLinkResponseDTO;
use Tests\TestCase;

class CreatePaymentLinkResponseDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CreatePaymentLinkResponseDTO::fromArray([
            'linkPayment' => $this->uuid(),
            'error' => $this->uuid(),
            'errorCode' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CreatePaymentLinkResponseDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CreatePaymentLinkResponseDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'linkPayment' => 'linkPayment',
                    'error' => 'error',
                    'errorCode' => 'errorCode',
                ],
                'expectedData' => [
                    'linkPayment' => 'linkPayment',
                    'error' => 'error',
                    'errorCode' => 'errorCode',
                ],
            ],
            'Test expects null by default' => [
                'data' => [],
                'expectedData' => [
                    'linkPayment' => null,
                    'error' => null,
                    'errorCode' => null,
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
        $dto = CreatePaymentLinkResponseDTO::fromArray($data);
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
            'Test isSuccess expects false if error' => [
                'method' => 'isSuccess',
                'methodData' => [],
                'data' => [
                    'linkPayment' => 'linkPayment',
                    'error' => 'error',
                    'errorCode' => 'errorCode',
                ],
                'expectedResult' => false,
            ],

            'Test isSuccess expects true ' => [
                'method' => 'isSuccess',
                'methodData' => [],
                'data' => [
                    'linkPayment' => 'linkPayment',
                ],
                'expectedResult' => true,
            ],
        ];
    }
}
