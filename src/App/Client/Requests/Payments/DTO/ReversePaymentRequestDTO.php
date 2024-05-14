<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Action;
use Dots\Portmone\App\Client\Requests\Payments\DTO\Consts\Method;

class ReversePaymentRequestDTO extends DTO
{
    protected string $login;

    protected string $password;

    protected string $shop_bill_id;

    protected ?string $encoding;

    protected ?string $lang;

    public function toRequestData(): array
    {
        return [
            'method' => Method::PREAUTH->value,
            'action' => Action::REJECT->value,
            'login' => $this->getLogin(),
            'password' => $this->getPassword(),
            'shop_bill_id' => $this->getShopBillId(),
            'encoding' => $this->getEncoding(),
            'lang' => $this->getLang(),
        ];
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getShopBillId(): string
    {
        return $this->shop_bill_id;
    }

    public function getEncoding(): ?string
    {
        return $this->encoding;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }
}
