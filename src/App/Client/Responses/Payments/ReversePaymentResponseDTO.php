<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;
use RuntimeException;
use Saloon\Http\Response;

class ReversePaymentResponseDTO extends PortmoneResponseDTO
{
    protected string $shop_bill_id;

    protected string $bill_number;

    protected string $description;

    protected float $bill_amount;

    protected string $status;

    protected ?string $bank_id;

    protected ?string $terminal_id;

    protected ?string $merchant_id;

    protected ?string $rrn;

    protected ?string $auth_code;

    protected ?string $attribute1;

    protected ?string $attribute2;

    protected ?string $attribute3;

    protected ?string $attribute4;

    protected ?string $attribute6;

    protected ?string $commission;

    protected ?string $error_code;

    protected ?string $error_message;

    public static function fromResponse(Response $response): static
    {
        $data = $response->json();
        if (!is_array($data)) {
            throw new RuntimeException('Invalid response data');
        }
        if (!isset($data[0])) {
            throw new RuntimeException('Invalid response data');
        }

        return static::fromArray($data[0]);
    }

    public function getShopBillId(): string
    {
        return $this->shop_bill_id;
    }

    public function getBillNumber(): string
    {
        return $this->bill_number;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getBillAmount(): float
    {
        return $this->bill_amount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getBankId(): ?string
    {
        return $this->bank_id;
    }

    public function getTerminalId(): ?string
    {
        return $this->terminal_id;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchant_id;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }

    public function getAttribute1(): ?string
    {
        return $this->attribute1;
    }

    public function getAttribute2(): ?string
    {
        return $this->attribute2;
    }

    public function getAttribute3(): ?string
    {
        return $this->attribute3;
    }

    public function getAttribute4(): ?string
    {
        return $this->attribute4;
    }

    public function getAttribute6(): ?string
    {
        return $this->attribute6;
    }

    public function getCommission(): ?string
    {
        return $this->commission;
    }

    public function getErrorCode(): ?string
    {
        return $this->error_code;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }
}
