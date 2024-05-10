<?php
/**
 * Description of OrderStatus.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources\Consts;

enum OrderStatus: string
{
    case CREATED = 'created';

    case PROCESSING = 'processing';

    case APPROVED = 'approved';

    case DECLINED = 'declined';

    case EXPIRED = 'expired';

    case REVERSED = 'reversed';

    public function isCreated(): bool
    {
        return $this === self::CREATED;
    }

    public function isProcessing(): bool
    {
        return $this === self::PROCESSING;
    }

    public function isApproved(): bool
    {
        return $this === self::APPROVED;
    }

    public function isDeclined(): bool
    {
        return $this === self::DECLINED;
    }

    public function isExpired(): bool
    {
        return $this === self::EXPIRED;
    }

    public function isReversed(): bool
    {
        return $this === self::REVERSED;
    }
}
