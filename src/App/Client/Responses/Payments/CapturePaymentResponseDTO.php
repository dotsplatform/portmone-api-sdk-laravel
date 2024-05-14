<?php
/**
 * Description of CreatePortmonePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CapturePaymentResponseDTO extends PortmoneResponseDTO
{
    protected ?string $shop_bill_id;

    protected ?string $shop_order_number;

    protected ?string $description;

    protected ?string $bill_date;

    protected ?string $pay_date;

    protected ?string $pay_order_date;

    protected ?string $bill_amount;

    protected ?string $auth_code;

    protected ?string $status;

    protected ?string $attribute1;

    protected ?string $attribute2;

    protected ?string $error_code;

    protected ?string $error_message;
}
