<?php

declare(strict_types=1);

namespace BoxlandCrm\Model\Users;

enum UserStatus: string
{
    case Active = 'active';
    case Blocked = 'blocked';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Активен',
            self::Blocked => 'Заблокирован',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Blocked => 'danger',
        };
    }
}
