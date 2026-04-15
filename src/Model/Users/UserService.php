<?php

declare(strict_types=1);

namespace BoxlandCrm\Model\Users;

use Mileena\DBMQ\Crud;
use Mileena\DBMQ\DTO;
use Mileena\Web\WebApp;

/**
 * @extends Crud<User>
 */
class UserService extends Crud
{
    protected static function getTableName(): string
    {
        return "admin_users";
    }

    protected static function getDtoClass(): string
    {
        return User::class;
    }

    public static function getActiveList(): array
    {
        return self::makeList("select * from admin_users where deleted_at is null order by id asc", "id", [], self::getDtoClass());
    }

    public static function getAllList(): array
    {
        return self::makeList("select * from admin_users order by fio desc", "id", [], self::getDtoClass());
    }

    public static function authenticate(string $login, $password): array
    {
        $hash = self::getHashPassword($password);

        $one = self::makeOne(
            "select * from admin_users where status = 1 && username = ? && password = ?",
            [$login, $hash],
        );

        if (!$one) {
            return [];
        }

        return $one->toArray();
    }

    public static function getHashPassword(string $password): string
    {
        return sha1(WebApp::getInstance()->config->get('app.password_salt') . $password);
    }

    public static function save(array|DTO $data, int|string|null $pkId = null, ?string $table = null, string $key = 'id'): int|string
    {
        return parent::save($data, $pkId, $table, $key);
    }
}
