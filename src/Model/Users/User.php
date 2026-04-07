<?php

declare(strict_types=1);

namespace Mileena\CrmSkeleton\Model\Users;

use Mileena\DBMQ\AbstractDTO;

class User extends AbstractDTO
{
    public const int CLIENT_ID = 9;

    public readonly int $id;

    public function __construct(
        public ?string    $username = '',
        public ?string    $fio = '',
        public ?\DateTime $createdAt = new \DateTime('0000-00-00 00:00:00'),
        public ?\DateTime $latestAt = new \DateTime('0000-00-00 00:00:00'),
        public ?int       $status = 0,
        public ?string    $password = null
    ) {
    }

}
