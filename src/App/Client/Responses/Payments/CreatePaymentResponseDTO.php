<?php
/**
 * Description of CreatePaymentResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Responses\Payments;

use Dots\Data\DTO;
use Dots\Portmone\App\Client\Responses\PortmoneResponseDTO;

class CreatePaymentResponseDTO extends PortmoneResponseDTO
{
    public const RESULT_SUCCESS = '0';

    protected string $SHOPBILLID;

    protected string $SHOPORDERNUMBER;

    protected ?string $APPROVALCODE;

    protected float $BILL_AMOUNT;

    protected ?string $TOKEN;

    protected string $RESULT;

    protected ?string $CARD_MASK;

    protected ?string $ATTRIBUTE1;

    protected ?string $ATTRIBUTE2;

    protected ?string $ATTRIBUTE3;

    protected ?string $ATTRIBUTE4;

    protected string $RECEIPT_URL;

    protected ?string $LANG;

    protected ?string $DESCRIPTION;

    protected ?string $IPSTOKEN;

    protected ?string $ERRORIPSCODE;

    protected ?string $ERRORIPSMESSAGE;

    public function isSuccess(): bool
    {
        return $this->getRESULT() === self::RESULT_SUCCESS;
    }

    public function getSHOPBILLID(): string
    {
        return $this->SHOPBILLID;
    }

    public function getSHOPORDERNUMBER(): string
    {
        return $this->SHOPORDERNUMBER;
    }

    public function getAPPROVALCODE(): ?string
    {
        return $this->APPROVALCODE;
    }

    public function getBILLAMOUNT(): float
    {
        return $this->BILL_AMOUNT;
    }

    public function getTOKEN(): ?string
    {
        return $this->TOKEN;
    }

    public function getRESULT(): string
    {
        return $this->RESULT;
    }

    public function getCARDMASK(): ?string
    {
        return $this->CARD_MASK;
    }

    public function getATTRIBUTE1(): ?string
    {
        return $this->ATTRIBUTE1;
    }

    public function getATTRIBUTE2(): ?string
    {
        return $this->ATTRIBUTE2;
    }

    public function getATTRIBUTE3(): ?string
    {
        return $this->ATTRIBUTE3;
    }

    public function getATTRIBUTE4(): ?string
    {
        return $this->ATTRIBUTE4;
    }

    public function getRECEIPTURL(): string
    {
        return $this->RECEIPT_URL;
    }

    public function getLANG(): ?string
    {
        return $this->LANG;
    }

    public function getDESCRIPTION(): ?string
    {
        return $this->DESCRIPTION;
    }

    public function getIPSTOKEN(): ?string
    {
        return $this->IPSTOKEN;
    }

    public function getERRORIPSCODE(): ?string
    {
        return $this->ERRORIPSCODE;
    }

    public function getERRORIPSMESSAGE(): ?string
    {
        return $this->ERRORIPSMESSAGE;
    }
}
