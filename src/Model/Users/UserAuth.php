<?php
declare(strict_types=1);

namespace Mileena\Web;

use BoxlandCrm\Model\Users\UserRole;

class UserAuth extends Auth {

    public static function isAdmin() :bool {
        return self::checkRole(UserRole::Administrator->value);
    }

    public static function isMember() :bool {
        return self::checkRole(UserRole::Member->value);
    }
}