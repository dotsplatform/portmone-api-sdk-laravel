<?php
/**
 * Description of PayeeTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Portmone\App\Client\Resources\Payee;
use Tests\TestCase;

class PayeeTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Payee::fromArray([
            'payeeId' => $this->uuid(),
            'login' => $this->uuid(),
            'dt' => $this->uuid(),
            'signature' => $this->uuid(),
            'shopSiteId' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Payee::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Payee::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'payeeId' => 'payeeId',
                    'login' => 'login',
                    'dt' => 'dt',
                    'signature' => 'signature',
                    'shopSiteId' => 'shopSiteId',
                ],
                'expectedData' => [
                    'payeeId' => 'payeeId',
                    'login' => 'login',
                    'dt' => 'dt',
                    'signature' => 'signature',
                    'shopSiteId' => 'shopSiteId',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'payeeId' => 'payeeId',
                    'login' => 'login',
                    'dt' => 'dt',
                ],
                'expectedData' => [
                    'signature' => null,
                    'shopSiteId' => null,
                ],
            ],
        ];
    }
}
