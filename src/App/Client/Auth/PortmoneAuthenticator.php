<?php
/**
 * Description of TranzzoAuthenticator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Auth;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class PortmoneAuthenticator implements Authenticator
{
    public function __construct(
        private readonly PortmoneAuthDTO $authDTO,
    ) {
    }

    public static function fromAuthDTO(PortmoneAuthDTO $dto): static
    {
        return new static($dto);
    }

    public function set(PendingRequest $pendingRequest): void
    {
        if (! $pendingRequest->body()) {
            return;
        }

        $data = $pendingRequest->body()->all();
        if (! is_array($data)) {
            return;
        }
        $data = $this->signRequest($data);
        $pendingRequest->body()->set($data);
    }

    private function signRequest(array $data): array
    {
        return PortmoneSignature::sign($this->authDTO, $data);
    }
}
