<?php

namespace App\Constant;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatutPaidEnum: int implements HasColor, HasLabel
{
    case Paid = 1;
    case NotPaid = 2;
    case Pending = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::NotPaid => 'Not paid',
            self::Pending => 'Pending',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Paid => 'warning',
            self::NotPaid => 'success',
            self::Pending => 'danger',
        };
    }
}
