<?php
/**
 * Description of CreatePaymentLinkRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Dots\Portmone\App\Client\Auth\PortmoneSignature;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;
use Dots\Portmone\App\Client\Requests\Payments\DTO\CreatePaymentLinkRequestDTO;
use Dots\Portmone\App\Client\Resources\Consts\Currency;
use Dots\Portmone\App\Client\Resources\Consts\Preauth;
use Dots\Portmone\App\Client\Resources\Order;
use Dots\Portmone\App\Client\Resources\Payee;
use Tests\TestCase;

class CreatePaymentLinkRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CreatePaymentLinkRequestDTO::fromArray([
            'payee' => Payee::fromArray([
                'payeeId' => $this->uuid(),
                'login' => $this->uuid(),
                'dt' => $this->uuid(),
                'signature' => $this->uuid(),
                'shopSiteId' => $this->uuid(),
            ]),
            'order' => Order::fromArray([
                'shopOrderNumber' => $this->uuid(),
                'billAmount' => 100,
                'successUrl' => $this->uuid(),
                'failureUrl' => $this->uuid(),
                'preauthFlag' => Preauth::Y,
                'preauthConfirm' => $this->uuid(),
                'preauthReject' => $this->uuid(),
                'billCurrency' => Currency::UAH,
                'expTime' => $this->uuid(),
            ]),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CreatePaymentLinkRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CreatePaymentLinkRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'payee' => Payee::fromArray([
                        'payeeId' => 'payeeId',
                        'login' => 'login',
                        'dt' => 'dt',
                        'signature' => 'signature',
                        'shopSiteId' => 'shopSiteId',
                    ]),
                    'order' => Order::fromArray([
                        'shopOrderNumber' => 'shopOrderNumber',
                        'billAmount' => 100,
                        'successUrl' => 'successUrl',
                        'failureUrl' => 'failureUrl',
                        'preauthFlag' => Preauth::Y,
                        'preauthConfirm' => 'preauthConfirm',
                        'preauthReject' => 'preauthReject',
                        'billCurrency' => Currency::UAH,
                        'expTime' => 'expTime',
                    ]),
                ],
                'expectedData' => [
                    'payee' => [
                        'payeeId' => 'payeeId',
                        'login' => 'login',
                        'dt' => 'dt',
                        'signature' => 'signature',
                        'shopSiteId' => 'shopSiteId',
                    ],
                    'order' => [
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
            ],
        ];
    }

    public function testToRequestData(): void
    {
        $password = $this->uuid();
        $key = $this->uuid();
        $dto = CreatePaymentLinkRequestDTO::fromArray([
            'payee' => Payee::fromArray([
                'payeeId' => $this->uuid(),
                'login' => $this->uuid(),
                'dt' => $this->uuid(),
                'signature' => $this->uuid(),
                'shopSiteId' => $this->uuid(),
            ]),
            'order' => Order::fromArray([
                'shopOrderNumber' => $this->uuid(),
                'billAmount' => 100,
                'successUrl' => $this->uuid(),
                'failureUrl' => $this->uuid(),
                'preauthFlag' => Preauth::Y,
                'preauthConfirm' => $this->uuid(),
                'preauthReject' => $this->uuid(),
                'billCurrency' => Currency::UAH,
                'expTime' => $this->uuid(),
            ]),
        ]);
        $authDTO = PortmoneAuthDTO::fromArray([
            'login' => $dto->getPayee()->getLogin(),
            'password' => $password,
            'payeeId' => $dto->getPayee()->getPayeeId(),
            'key' => $key,
        ]);

        $data = $dto->toRequestData($authDTO);
        $this->assertEquals(Method::CREATE_LINK_PAYMENT->value, $data['method']);
        $this->assertEquals($dto->getOrder()->toArray(), $data['order']);
        $this->assertEquals($dto->getPayee()->getDt(), $data['payee']['dt']);
        $this->assertEquals($dto->getPayee()->getLogin(), $data['payee']['login']);
        $this->assertEquals($dto->getPayee()->getPayeeId(), $data['payee']['payeeId']);
        $this->assertEquals($dto->getPayee()->getShopSiteId(), $data['payee']['shopSiteId']);
        $this->assertEquals(
            PortmoneSignature::generateForPaymentCreate($authDTO, $dto),
            $data['payee']['signature']
        );
    }
}
