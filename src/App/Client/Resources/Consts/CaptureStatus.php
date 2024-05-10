<?php
/**
 * Description of CaptureStatus.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources\Consts;

enum CaptureStatus: string
{
    case CAPTURED = 'captured';

    public function isCaptured(): bool
    {
        return $this === self::CAPTURED;
    }
}
