<?php

namespace App\Enums;

enum MembershipStatus: string
{
    case INVITED = 'invited';
    case ACTIVE = 'active';

    public function label(): string
    {
        return match ($this) {
            self::INVITED => 'invited',
            self::ACTIVE => 'active',
        };
    }

    public static function values(): array
    {
        return array_map(fn (MembershipStatus $status) => $status->value, MembershipStatus::cases());
    }
}
