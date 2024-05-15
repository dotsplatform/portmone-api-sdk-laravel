<?php
/**
 * Description of PortmoneAuthDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Auth\DTO;

use Dots\Data\DTO;

class PortmoneAuthDTO extends DTO
{
    protected string $login;

    protected string $password;

    protected string $payeeId;

    protected string $key;

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPayeeId(): string
    {
        return $this->payeeId;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
