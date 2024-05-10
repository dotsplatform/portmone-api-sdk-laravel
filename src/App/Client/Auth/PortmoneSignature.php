<?php
/**
 * Description of PortmoneSignature.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Auth;

use Dots\Portmone\App\Client\Auth\DTO\PortmoneAuthDTO;

class PortmoneSignature
{
    public static function sign(PortmoneAuthDTO $dto, array $params): array
    {
        if (! empty($params['request']['signature'])) {
            return $params;
        }
        $params['request']['signature'] = self::generate($dto, $params);

        return $params;
    }

    public static function generate(PortmoneAuthDTO $dto, array $params): string
    {
        $params = array_filter($params, 'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift($params, $dto->getPassword());
        $params = implode('|', $params);

        return sha1($params);
    }

    public static function check(PortmoneAuthDTO $dto, array $response): bool
    {
        if (! array_key_exists('signature', $response)) {
            return false;
        }
        $signature = $response['signature'];
        $response = self::clean($response);

        return $signature === self::generate($dto, $response);
    }

    public static function clean(array $data): array
    {
        if (array_key_exists('response_signature_string', $data)) {
            unset($data['response_signature_string']);
        }
        unset($data['signature']);

        return $data;
    }
}
