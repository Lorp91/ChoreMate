<?php

namespace App\Enums;

enum HouseholdRole: string
{
    case OWNER = 'owner';
    case MEMBER = 'member';

    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'owner',
            self::MEMBER => 'member',
        };
    }

    public static function values(): array
    {
        return array_map(fn (HouseholdRole $role) => $role->value, HouseholdRole::cases());
    }
}
