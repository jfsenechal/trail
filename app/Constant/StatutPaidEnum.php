<?php

namespace App\Constant;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum StatutPaidEnum: int implements HasColor, HasLabel, HasDescription
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

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Paid => 'This has not finished being written yet.',
            self::NotPaid => 'This is ready for a staff member to read.',
            self::Pending => 'This has been approved by a staff member and is public on the website.',
        };
    }
}
