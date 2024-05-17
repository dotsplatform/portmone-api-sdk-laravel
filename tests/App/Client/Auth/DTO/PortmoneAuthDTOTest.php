<?php
/**
 * Description of PortmoneAuthDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Auth\DTO;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Tests\TestCase;

class PortmoneAuthDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PortmoneAuthDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
            'payeeId' => $this->uuid(),
            'key' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            PortmoneAuthDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = PortmoneAuthDTO::fromArray($data);
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
                    'key' => 'key',
                ],
                'expectedData' => [
                    'login' => 'login',
                    'password' => 'password',
                    'payeeId' => 'payeeId',
                    'key' => 'key',
                ],
            ],
        ];
    }
}
