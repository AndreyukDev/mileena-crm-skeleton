<?php

declare(strict_types=1);

namespace BoxlandCrm\Model\Users;

enum UserRole: string
{
    case Administrator = 'administrator';
    case Member = 'member';

    public function label(): string
    {
        return match ($this) {
            self::Administrator => 'Администратор',
            self::Member => 'Участник',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Administrator => 'danger',
            self::Member => 'success',
        };
    }
}
