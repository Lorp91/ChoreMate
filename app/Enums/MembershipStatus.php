<?php

namespace App\Enums;

enum MembershipStatus: string
{
    case INVITED = 'invited';
    case ACTIVE = 'active';
    case DECLINED = 'declined';
    case REMOVED = 'removed';

    public function label(): string
    {
        return match ($this) {
            self::INVITED => 'invited',
            self::ACTIVE => 'active',
            self::DECLINED => 'declined',
            self::REMOVED => 'removed',
        };
    }

    public static function values(): array
    {
        return array_map(fn (MembershipStatus $status) => $status->value, MembershipStatus::cases());
    }
}
