<?php

declare(strict_types=1);

namespace BoxlandCrm\Controller;

use BoxlandCrm\Model\Users\User;
use BoxlandCrm\Model\Users\UserRole;
use BoxlandCrm\Model\Users\UserService;
use BoxlandCrm\Model\Users\UserStatus;
use BoxlandCrm\View\View;
use DateTimeImmutable;
use Mileena\Web\AllowPublicAccess;
use Mileena\Web\Auth;
use Mileena\Web\Params;
use Mileena\Web\Response;
use Mileena\Web\UserAuth;

class ManagerController
{
    #[AllowPublicAccess]
    public function login(): void
    {
        $p = Params::getParams();
        $v = View::getView();

        // если пароли подходят
        if ($p->has('login') && $p->has('password')) {
            $authUser = UserService::authenticate(
                $p->getStrval('login'),
                $p->getStrval('password'),
            );

            if (Auth::login($authUser)) {
                // перенаправляемся на главную
                Response::redirect('/');

                return;
            } else {
                $v->assign("error", "Неправильный логин или пароль");
            }
        }

        $v->display('/manager/login.phtml');
    }

    public function logout(): void
    {
        Auth::logout();
        Response::redirect('/manager/login');
    }

    public function index(): void
    {
        View::getView()
            ->assign("_pageTitle", "Менеджеры")
            ->assign("list", UserService::getActiveList())
            ->display("/manager/index.phtml");
    }

    public function add(): void
    {
        if (UserAuth::isMember()) {
            Response::redirect('/manager');
        }

        View::getView()
            ->assign("_pageTitle", "Добавление менеджера")
            ->display("/manager/form.phtml");
    }

    public function edit(): void
    {
        $userId = Params::getParams()->getIntval('id');

        View::getView()
            ->assign("_pageTitle", "Редактирование менеджера")
            ->assign("user", UserService::getById($userId))
            ->display("/manager/form.phtml");
    }

    public function save(): void
    {
        $p = Params::getParams();
        $user = UserService::getById($p->getIntval('id'));

        if (UserAuth::isMember() && (!$user || $user->id !== UserAuth::getUserId())) {
            Response::redirect('/manager');
        }

        if (!$user) {
            $user = new User();
            $user->username = $p->getString('username');
            $user->createdAt = new \DateTimeImmutable('now');
        }

        $user->updatedAt = new DateTimeImmutable();

        $user->fio = $p->getStrval('fio');

        if ($p->has('id') && $user->id !== 1) {
            $user->status = UserStatus::from($p->getStrval('status'));
            $user->role = UserRole::from($p->getStrval('role'));
        }

        if ($p->has('password') && $p->getStrval('password') == $p->getStrval('password_confirm')) {
            $user->password = UserService::getHashPassword($p->getStrval('password'));
        }

        UserService::save($user, $p->getIntval('id'));

        Response::redirect('/manager');
    }

    public function delete(): void
    {
        if (UserAuth::isMember()) {
            Response::redirect('/manager');
        }

        $user = UserService::getById(Params::getParams()->getIntval('id'));

        if ($user->id == 1) {
            Response::redirect('/manager');
        }

        $user->status = UserStatus::Blocked;
        $user->deletedAt = new DateTimeImmutable();

        UserService::save($user, $user->id);
        Response::redirect('/manager');
    }
}
