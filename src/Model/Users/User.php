<?php

declare(strict_types=1);

namespace BoxlandCrm\Model\Users;

use Mileena\DBMQ\AbstractDTO;

class User extends AbstractDTO
{
    public const int CLIENT_ID = 9;
    public readonly int $id;

    public function __construct(
        public ?string    $username = '',
        public ?string    $fio = '',
        public UserStatus $status = UserStatus::Active,
        public UserRole $role = UserRole::Member,
        public ?string $password = null,
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $latestAt = null,
        public ?\DateTimeImmutable $updatedAt = null,
        public ?\DateTimeImmutable $deletedAt = null,
    ) {}
}
