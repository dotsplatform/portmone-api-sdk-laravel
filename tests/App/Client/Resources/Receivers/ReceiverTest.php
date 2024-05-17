<?php
/**
 * Description of ReceiverTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources\Receivers;

use Dots\Portmone\App\Client\Resources\Receivers\Receiver;
use Tests\TestCase;

class ReceiverTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Receiver::fromArray([
            'payeeId' => $this->uuid(),
            'amount' => 10.5,
            'description' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Receiver::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Receiver::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'payeeId' => 'payeeId',
                    'amount' => 10.5,
                    'description' => 'description',
                ],
                'expectedData' => [
                    'payeeId' => 'payeeId',
                    'amount' => 10.5,
                    'description' => 'description',
                ],
            ],
        ];
    }
}
