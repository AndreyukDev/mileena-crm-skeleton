<?php

declare(strict_types=1);

return [
    'crm_name' => 'CRM',
    'default_controller' => 'manager',
    'default_controller_method' => 'index',
    'default_login_page' => '/manager/login',
    'controller_namespace' => '\Mileena\CrmSkeleton\Controller\\',
    'controllers' => [
        'manager' => 'Manager',
    ],
    "password_salt" => $_ENV['SECURITY_PASSWORD_SALT'] ?? 'SECURITY_PASSWORD_SALT',

    "view_dir" => ROOT_DIR . 'src/View/',
];
