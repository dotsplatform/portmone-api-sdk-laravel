<?php
/**
 * Description of OrderTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Portmone\App\Client\Resources\Consts\Currency;
use Dots\Portmone\App\Client\Resources\Consts\Preauth;
use Dots\Portmone\App\Client\Resources\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Order::fromArray([
            'shopOrderNumber' => $this->uuid(),
            'billAmount' => 100,
            'successUrl' => $this->uuid(),
            'failureUrl' => $this->uuid(),
            'preauthFlag' => Preauth::Y,
            'preauthConfirm' => $this->uuid(),
            'preauthReject' => $this->uuid(),
            'billCurrency' => Currency::UAH,
            'expTime' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Order::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Order::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'shopOrderNumber' => 'shopOrderNumber',
                    'billAmount' => 100,
                    'successUrl' => 'successUrl',
                    'failureUrl' => 'failureUrl',
                    'preauthFlag' => Preauth::Y,
                    'preauthConfirm' => 'preauthConfirm',
                    'preauthReject' => 'preauthReject',
                    'billCurrency' => Currency::UAH,
                    'expTime' => 'expTime',
                ],
                'expectedData' => [
                    'shopOrderNumber' => 'shopOrderNumber',
                    'billAmount' => 100,
                    'successUrl' => 'successUrl',
                    'failureUrl' => 'failureUrl',
                    'preauthFlag' => Preauth::Y->value,
                    'preauthConfirm' => 'preauthConfirm',
                    'preauthReject' => 'preauthReject',
                    'billCurrency' => Currency::UAH->value,
                    'expTime' => 'expTime',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'shopOrderNumber' => 'shopOrderNumber',
                    'billAmount' => 100,
                    'successUrl' => 'successUrl',
                    'failureUrl' => 'failureUrl',
                    'preauthFlag' => Preauth::Y,
                    'billCurrency' => Currency::UAH,
                ],
                'expectedData' => [
                    'preauthConfirm' => null,
                    'preauthReject' => null,
                    'expTime' => null,
                ],
            ],
        ];
    }
}
