<?php
/**
 * Description of ReceiversTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources\Receivers;

use Dots\Portmone\App\Client\Resources\Receivers\Receivers;
use Tests\TestCase;

class ReceiversTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Receivers::fromArray([
            [
                'payeeId' => $this->uuid(),
                'amount' => 10.5,
                'description' => $this->uuid(),
            ],
            [
                'payeeId' => $this->uuid(),
                'amount' => 20.5,
                'description' => $this->uuid(),
            ],
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Receivers::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Receivers::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    [
                        'payeeId' => 'payeeId_1',
                        'amount' => 10.5,
                        'description' => 'description_1',
                    ],
                    [
                        'payeeId' => 'payeeId_2',
                        'amount' => 20.5,
                        'description' => 'description_2',
                    ],
                ],
                'expectedData' => [
                    [
                        'payeeId' => 'payeeId_1',
                        'amount' => 10.5,
                        'description' => 'description_1',
                    ],
                    [
                        'payeeId' => 'payeeId_2',
                        'amount' => 20.5,
                        'description' => 'description_2',
                    ],
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
        $dto = Receivers::fromArray($data);
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
            'Test getAsString expects data' => [
                'method' => 'getAsString',
                'methodData' => [],
                'data' => [
                    [
                        'payeeId' => 'payeeId_1',
                        'amount' => 10.5,
                        'description' => 'description_1',
                    ],
                    [
                        'payeeId' => 'payeeId_2',
                        'amount' => 20.5,
                        'description' => 'description_2',
                    ],
                ],
                'expectedResult' => 'description_1:payeeId_1;10.5;description_2:payeeId_2;20.5;',
            ],
        ];
    }
}
