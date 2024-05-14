<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

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
}
