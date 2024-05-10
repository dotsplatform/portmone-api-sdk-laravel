<?php
/**
 * Description of Payment.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App\Client\Resources;

use Dots\Data\Entity;
use Dots\Portmone\App\Client\Resources\Consts\CaptureStatus;
use Dots\Portmone\App\Client\Resources\Consts\OrderStatus;

class PortmonePayment extends Entity
{
    protected string $order_id;

    protected ?string $payment_id;

    protected string $rrn;

    protected ?string $masked_card;

    protected ?string $sender_cell_phone;

    protected OrderStatus $order_status;

    protected ?string $sender_account;

    protected ?string $fee;

    protected ?string $actual_amount;

    protected ?array $transaction;

    protected ?string $card_bin;

    protected ?string $card_type;

    protected string $amount;

    protected ?CaptureStatus $capture_status;

    public function getProviderPaymentId(): string
    {
        return $this->getPaymentId() ?: '';
    }

    public function getActualAmount(): int
    {
        return (int) $this->actual_amount;
    }

    public function isFailed(): bool
    {
        return $this->isExpired() || $this->isDeclined();
    }

    public function isApproved(): bool
    {
        return $this->getOrderStatus()->isApproved();
    }

    public function isCaptured(): bool
    {
        return $this->getCaptureStatus()?->isCaptured() ?? false;
    }

    public function isExpired(): bool
    {
        return $this->getOrderStatus()->isExpired();
    }

    public function isDeclined(): bool
    {
        return $this->getOrderStatus()->isDeclined();
    }

    public function isProcessing(): bool
    {
        return $this->getOrderStatus()->isProcessing();
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getMaskedCard(): ?string
    {
        return $this->masked_card;
    }

    public function getSenderCellPhone(): ?string
    {
        return $this->sender_cell_phone;
    }

    public function getOrderStatus(): OrderStatus
    {
        return $this->order_status;
    }

    public function getSenderAccount(): ?string
    {
        return $this->sender_account;
    }

    public function getFee(): ?float
    {
        $fee = $this->fee;
        if (! $fee) {
            return null;
        }
        $fee = (float) $fee;
        if (! $fee) {
            return null;
        }

        return $fee;
    }

    public function getTransaction(): ?array
    {
        return $this->transaction;
    }

    public function getCardBin(): ?string
    {
        return $this->card_bin;
    }

    public function getCardType(): ?string
    {
        return $this->card_type;
    }

    public function getAmount(): int
    {
        return (int) $this->amount;
    }

    public function getCaptureStatus(): ?CaptureStatus
    {
        return $this->capture_status;
    }
}
