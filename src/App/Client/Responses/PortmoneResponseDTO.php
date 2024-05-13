<?php
/**
 * Description of PlateByMonoResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses;

use Dots\Data\DTO;
use Saloon\Http\Response;

abstract class PortmoneResponseDTO extends DTO
{
    public static function fromResponse(Response $response): static
    {
        return static::fromArray($response->json()['response'] ?? []);
    }
}
